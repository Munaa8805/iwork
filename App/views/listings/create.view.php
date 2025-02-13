<?php loadPartial("head"); ?>
<?php loadPartial("navbar"); ?>

<?php loadPartial("top-banner"); ?>

<!-- Post a Job Form Box -->
<section class="flex justify-center items-center mt-20">
    <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
        <h2 class="text-4xl text-center font-bold mb-4">Create Job Listing</h2>
        <!-- <div class="message bg-red-100 p-3 my-3">This is an error message.</div>
        <div class="message bg-green-100 p-3 my-3">
            This is a success message.
        </div> -->
        <form method="POST" action="/listings">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Job Info
            </h2>
            <!-- <?php if (isset($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="message bg-red-100 p-3 my-3">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>


            <?php endif; ?> -->


            <?=
            loadPartial("errors", [
                "errors" => $errors ?? []
            ]);



            ?>

            <div class="mb-4">
                <input type="text" name="title" placeholder="Job Title" value="Title test"
                    class="w-full px-4 py-2 border rounded focus:outline-none" <?= $listing["title"] ?? "" ?> />
            </div>
            <div class="mb-4">
                <textarea name="description" placeholder="Job Description" value="Description test"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    <?= $listing["description"] ?? "" ?>></textarea>
            </div>
            <div class="mb-4">
                <input type="text" name="salary" placeholder="Annual Salary" value="100000"
                    class="w-full px-4 py-2 border rounded focus:outline-none" <?= $listing["salary"] ?? "" ?> />
            </div>
            <div class="mb-4">
                <input type="text" name="requirements" placeholder="Requirements" value="Requirements test"
                    class="w-full px-4 py-2 border rounded focus:outline-none" <?= $listing["requirements"] ?? "" ?> />
            </div>
            <div class="mb-4">
                <input type="text" name="benefits" placeholder="Benefits" value="Benefits test"
                    class="w-full px-4 py-2 border rounded focus:outline-none" <?= $listing["benefits"] ?? "" ?> />
            </div>
            <div class="mb-4">
                <input type="text" name="tags" placeholder="Tags" value="Tags test"
                    class="w-full px-4 py-2 border rounded focus:outline-none" <?= $listing["tags"] ?? "" ?> />
            </div>
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Company Info & Location
            </h2>
            <div class="mb-4">
                <input type="text" name="company" placeholder="Company Name" value="Company test"
                    class="w-full px-4 py-2 border rounded focus:outline-none" <?= $listing["company"] ?? "" ?> />
            </div>
            <div class="mb-4">
                <input type="text" name="address" placeholder="Address" value="Address test"
                    class="w-full px-4 py-2 border rounded focus:outline-none" <?= $listing["address"] ?? "" ?> />
            </div>
            <div class="mb-4">
                <input type="text" name="city" placeholder="City" value="City test"
                    class="w-full px-4 py-2 border rounded focus:outline-none" <?= $listing["city"] ?? "" ?> />
            </div>
            <div class="mb-4">
                <input type="text" name="state" placeholder="State" value="State test"
                    class="w-full px-4 py-2 border rounded focus:outline-none" <?= $listing["state"] ?? "" ?> />
            </div>
            <div class="mb-4">
                <input type="text" name="phone" placeholder="Phone" value="88058822"
                    class="w-full px-4 py-2 border rounded focus:outline-none" <?= $listing["phone"] ?? "" ?> />
            </div>
            <div class="mb-4">
                <input type="email" name="email" placeholder="Email Address For Applications"
                    value=" <?= $listing["email"] ?? "" ?>" class="w-full px-4 py-2 border rounded focus:outline-none"
                    <?= $listing["email"] ?? "" ?> />
            </div>
            <button class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
                Save
            </button>
            <a href="/"
                class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">
                Cancel
            </a>
        </form>
    </div>
</section>

<?php loadPartial("bottom-banner"); ?>
<?php loadPartial("footer"); ?>