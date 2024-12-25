<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="process" method="POST">
        <fieldset>
            <legend>Academic Information</legend>
            Degree
            <select name="academic" id="">
                <option value="Bachelor of Science and Computer Science">Bachelor of Science in Computer Science</option>
                <option value="Bachelor of Science and Computer Science">Bachelor of Science in Information Technology</option>
                <option value="Bachelor of Science and Computer Science">Bachelor of Science in Criminology </option>
                <option value="Bachelor of Science and Computer Science">Bachelor of Science in Hospitality Management</option>
                <option value="Bachelor of Science and Computer Science">Bachelor of Science in Education</option>
            </select>
            <br>
            SchoolID <input type="text">
            <br>
            Class Attended <select name="classes[]" id="" multiple>
                <option value="Information Mangement">Information Management</option>
                <option value="Information Mangement">PATHFit</option>
                <option value="Information Mangement">SPEC 4</option>
                <option value="Information Mangement">SPEC 3</option>
                <option value="Information Mangement">Datastuct</option>
            </select>
        </fieldset>

        <fieldset>
            <legend>Personal Details</legend>
            <section name="firstname">First Name <input type="text" placeholder="Enter First Name"></section>
            <section name="lastname">Last Name <input type="text" placeholder="Enter Last Name"></section>
            <section name="dateOfBirth">Date of Birth <input type="date"></section>
            <section name="gender">Gender <input type="radio">Male <input type="radio">Female</section>
            <section name="email">Email <input type="email"></section>
        </fieldset>

        <input type="checkbox"> I agree to recieve email and content about this site periodically
        <br>
        <input type="checkbox">I dont want to recieve anything fron your site
        <br>
        <textarea name="" id="" placeholder="TERMS AND CONDITIONS..." rows="5" cols="50"></textarea>
        <br>
        <button type="submit">Send Form</button>
        <button type="reset">Delete Form</button>
    </form>
</body>
</html>