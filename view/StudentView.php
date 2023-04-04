<?php 

    class StudentView
    {
        function renderStudentList($students)
        {
            foreach($students as $student)
            {
                echo "<p>Name: $student->first_name $student->last_name</p>";
                echo "<p>Age: $student->age</p>";
                echo "<a href='/crud-v3/edit.php?id=$student->id'>Edit</a>";
                echo "  <a href='?delete_id=$student->id' onclick='return confirm(`Do you want to delete this?`)'>Delete</a>";
                echo "<hr/>";
            }
        }

        function renderCreateForm($errors=array())
        {
            $first_name_err = $errors['first_name'] ?? "";
            $last_name_err = $errors['last_name'] ?? "";
            $age_err = $errors['age'] ?? "";
            $old_first_name = $_POST["first_name"] ?? "";
            $old_last_name = $_POST["last_name"] ?? "";
            $old_age = $_POST["age"] ?? "";

            echo "
                <form method='POST'>
                    <label for='first_name'>First Name</label>
                    <input type='text' name='first_name' id='first_name' value='$old_first_name'>
                    <span class='error'>* $first_name_err </span>
                    <br/>
                    <label for='last_name'>Last Name</label>
                    <input type='text' name='last_name' id='last_name' value='$old_last_name'>
                    <span class='error'>* $last_name_err </span>
                    <br/>
                    <label for='age'>Age</label>
                    <input type='text' name='age' id='age' value='$old_age'>
                    <span class='error'>* $age_err </span>
                    <br/>
                    <button type='submit'>Submit</button>
                    <button type='reset'>Reset</button>
                </form>
            ";
        }

        function renderEditForm($student,$errors=array())
        {
            $first_name_err = $errors['first_name'] ?? "";
            $last_name_err = $errors['last_name'] ?? "";
            $age_err = $errors['age'] ?? "";

            echo "
                <form method='POST'>
                    <input type='hidden' name='id' value='$student->id'/>
                    <label for='first_name'>First Name</label>
                    <input type='text' name='first_name' id='first_name' value='$student->first_name'>
                    <span class='error'>* $first_name_err </span>
                    <br/>
                    <label for='last_name'>Last Name</label>
                    <input type='text' name='last_name' id='last_name' value='$student->last_name'>
                    <span class='error'>* $last_name_err </span>
                    <br/>
                    <label for='age'>Age</label>
                    <input type='text' name='age' id='age' value='$student->age'>
                    <span class='error'>* $age_err </span>
                    <br/>
                    <button type='submit'>Submit</button>
                    <button type='reset'>Reset</button>
                </form>
            ";
        }
    }
?>