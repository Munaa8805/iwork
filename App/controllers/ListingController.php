<?php


namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class ListingController
{
    protected $db;
    public function __construct()
    {
        $config = require basePath("config/_db.php");
        $this->db = new Database($config);
    }

    // Index method
    public function index()
    {



        $listings = $this->db->query("SELECT * FROM listings")->fetchAll();
        loadView("listings/index", ["listings" => $listings]);
    }
    public function create()
    {

        loadView("listings/create");
    }
    public function show($params)
    {
        $id = $params["id"] ?? '';

        $params = [
            "id" => $id
        ];
        // inspect($params);

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();
        // inspect($listing);

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }
        loadView("listings/show", ["listing" => $listing]);
    }

    public function store()
    {

        $allowedFields = [
            "title",
            "description",
            "salary",
            "requirements",
            "benefits",
            'tags',
            "company",
            "address",
            "city",
            "state",
            "phone"
        ];
        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));

        $newListingData = array_map('sanitize', $newListingData);
        // inspectAndDie($newListingData);
        $requiredFields = [
            "title",
            "description",
            "salary",
            "requirements",
            "benefits",
            'tags',
            "company",
            "address",
            "city",
            "state",
            "phone"
        ];
        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
                $errors[$field] = "The $field field is required";
            }
        }
        if (!empty($errors)) {
            loadView("listings/create", ["errors" => $errors, 'listing' => $newListingData]);
        } else {
            // $this->db->query('INSERT INTO listings (title, description, salary,tags,company, address, city, state, phone, email, requirements, benefits, user_id) VALUES (:title, :description, :salary,:tags, :company, :address, :city, :state, :phone,:email, :requirements, :benefits, :user_id)', $newListingData);


            $fields = [];
            foreach ($newListingData as $field => $value) {
                $fields[] = $field;
            }
            #

            $fields = implode(', ', $fields);
            $values = [];
            foreach ($newListingData as $field => $value) {
                if ($value === "") {
                    $newListingData[$field] = null;
                }
                $values[] = ':' . $field;
            }
            $values = implode(', ', $values);


            $query = "INSERT INTO listings ({$fields}) VALUES ({$values})";

            $this->db->query($query, $newListingData);
            redirect("/listings");
        }
    }


    public function destroy($params)
    {
        $id = $params["id"] ?? '';

        $params = [
            "id" => $id
        ];
        // inspect($params);

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();
        // inspect($listing);

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }
        $this->db->query('DELETE FROM listings WHERE id = :id', $params);
        redirect("/listings");
    }
}
