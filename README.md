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
| 90–100      | A+           | 4.0          |
| 85–89       | A            | 3.7          |
| 80–84       | A-           | 3.3          |
| 75–79       | B+           | 3.0          |
| 70–74       | B            | 2.7          |
| 65–69       | B-           | 2.3          |
| 60–64       | C+           | 2.0          |
| 50–59       | C            | 1.0          |
| 45–49       | C-           | 0.0          |
| 40–44       | D            | 0.0          |
| 0-39        | F            | 0.0          |

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

# GPAcalculator_laravel
