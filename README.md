<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Student GPA System

A Laravel-based mini system where instructors can manage student grades and calculate GPAs.

## Features

✅ **Student Management**

-   Add new students with name and email
-   View list of all students sorted by GPA
-   View detailed student information with all course enrollments

✅ **Course Management**

-   Pre-loaded courses with credit hours
-   DSA (5 credits), Networking (4 credits), Software (7 credits)

✅ **Grade Management**

-   Enter student scores (0-100) for each course
-   Automatic letter grade calculation
-   Automatic grade point calculation
-   GPA calculation based on credit hours

✅ **GPA Calculation**

-   Weighted GPA based on credit hours
-   Real-time GPA updates
-   Color-coded GPA display (Green: ≥3.0, Yellow: 2.0-2.9, Red: <2.0)

## Grade Scale

| Score Range | Letter Grade | Grade Points |
| ----------- | ------------ | ------------ |
| 90-100      | A            | 4.0          |
| 80-89       | B            | 3.0          |
| 70-79       | C            | 2.0          |
| 60-69       | D            | 1.0          |
| 0-59        | F            | 0.0          |

## GPA Calculation Formula

```
GPA = Total Quality Points ÷ Total Credit Hours
Quality Points = Credit Hours × Grade Points
```

## Installation & Setup

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd student-gpa-system
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Set up environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure database**

    - Update `.env` file with your database credentials
    - For SQLite: `DB_CONNECTION=sqlite` and create `database/database.sqlite`

5. **Run migrations and seeders**

    ```bash
    php artisan migrate:fresh --seed
    ```

6. **Start the server**

    ```bash
    php artisan serve
    ```

7. **Access the application**
    - Open http://localhost:8000 in your browser

## Usage

### Adding Students

1. Click "Add Student" button
2. Enter student name and email
3. Submit the form

### Adding Course Enrollments & Grades

1. Click "Add Enrollment" button
2. Select a student and course
3. Enter the score (0-100)
4. Submit the form

### Viewing Student Details

1. Click "View Details" on any student
2. See all enrollments, grades, and GPA calculation

### Viewing All Students

-   The main page shows all students sorted by GPA (highest first)
-   GPA is color-coded for quick visual assessment

## Database Structure

### Students Table

-   `id` (Primary Key)
-   `name` (String)
-   `email` (String, Unique)
-   `created_at`, `updated_at` (Timestamps)

### Courses Table

-   `id` (Primary Key)
-   `name` (String)
-   `credit_hours` (Integer)
-   `created_at`, `updated_at` (Timestamps)

### Enrollments Table

-   `id` (Primary Key)
-   `student_id` (Foreign Key)
-   `course_id` (Foreign Key)
-   `score` (Integer, 0-100)
-   `letter_grade` (String, A-F)
-   `grade_point` (Decimal, 0.0-4.0)
-   `created_at`, `updated_at` (Timestamps)

## Sample Data

The system comes pre-loaded with:

-   **Students**: Samuel Ayine, Jonas Gebru, Abebe Kebede
-   **Courses**: DSA (5 credits), Networking (4 credits), Software (7 credits)

## Technologies Used

-   **Backend**: Laravel 11
-   **Frontend**: Bootstrap 5
-   **Database**: SQLite (default) / MySQL / PostgreSQL
-   **PHP**: 8.1+

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
