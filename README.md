# Form Validation

This project implements a simple form submission system using Laravel. The form data is handled via a controller, stored in the database using a model, and displayed on the homepage.

## Files Overview

1. **Home Page:**  
   `resources/views/welcome.blade.php`
   
   This is the main view file where the form is displayed for users to submit their data.

2. **Controller:**  
   `app/Http/Controllers/FormController.php`
   
   This controller handles form submission logic and interacts with the database.

3. **Database Model:**  
   `app/Models/Form.php`
   
   The model represents the form data and interacts with the corresponding database table.

4. **Database Migration Schema:**  
   `database/migrations/2025_05_08_091955_create_forms_table.php`
   
   This migration file defines the schema for the `forms` table in the database.

