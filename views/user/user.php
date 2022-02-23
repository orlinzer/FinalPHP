<div class="card">
  <h2>User</h2>
  <p>Name: <?=$userToShow->getName()?></p>
  <p>Image:
  <img src="<?=$userToShow->getImage()?>" alt="Image"width="48" >
  </p>
  <p>About: <?=$userToShow->getAbout()?></p>
  <p>Email: <?=$userToShow->getEmail()?></p>
  <p>Phone: <?=$userToShow->getPhone()?></p>
  <p>Role: <?=$userToShow->getRole()?></p>
</div>