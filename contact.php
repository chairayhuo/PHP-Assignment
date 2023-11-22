<?php
include("header.php");?>

<body>
    <form action="process-contact.php" method="POST">
      <label for="Name">Name:</label>
      <input name="Name" required/>
      <label for="email">Email:</label>
      <input type="email" name="Email" required/>
      <label for="checkbox" >Category interests</label>
      <input type="checkbox" name="interests" value="Industry"/>
      <label for="checkbox">Industry</label>
      <input type="checkbox" name="interests" value="Technical"/>
      <label for="checkbox">Technical</label>
      <input type="checkbox" name="interests" value="Career"/>
      <label for="checkbox">Career</label>
      <label for="Your role">Your role</label>
      <select name="YourRole">
        <option value="Writer">Writer</option>
        <option value="Contributor">Contributor</option>
        <option value="Administrator">Administrator</option>
      </select>
      <input type="submit" />  
    </form>
</body>