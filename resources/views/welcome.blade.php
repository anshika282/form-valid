<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Submission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h4 class="mb-4">Submit Your Details</h4>
        <form action="/submit-form" method="POST" novalidate>
            @csrf
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name*</label>
                <input type="text" class="form-control" id="first_name" name="first_name" pattern="^[A-Za-z]+$" required>
                <div class="invalid-feedback">First name is required.</div>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name*</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
                <div class="invalid-feedback">Last name is required.</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address*</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone*</label>
                <input type="tel" class="form-control" id="phone" name="phone" pattern="^[6-9]\d{9}$" required>
                <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
            </div>
            <div class="mb-3">
                <label for="linkedin" class="form-label">LinkedIn Profile (optional)</label>
                <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/your-profile" regex="https?://.*" pattern="https?://.*">
                <div class="invalid-feedback">Please enter a valid LinkedIn URL.</div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>

<script>
    // Bootstrap validation
    (() => {
        'use strict'
        const forms = document.querySelectorAll('form')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        document.getElementById('phone').addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        form.addEventListener('submit', async function (event) {
            event.preventDefault();
            event.stopPropagation();

            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('/form-submit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Form submitted successfully!');
                    form.reset();
                    form.classList.remove('was-validated');
                } else {
                    alert(result.message || 'Submission failed.');
                }
            } catch (error) {
                alert('Something went wrong. Please try again.');
                console.error(error);
            }
        });
    });
</script>

</body>
</html>
