<nav class="navbar navbar-expand-lg navbar-light white" style="position: fixed; width: 100%;z-index: 20;">
  <a class="navbar-brand" href="checkproduct.php">
    <img src="images/logo.png"
      style="height: 50px; width: 50px; border: 3px solid #00b386; border-radius: 10px; background-color: #003326;"
      alt="MEDICHAIN"> &nbsp
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" style="color: #4287f5;"></span>
  </button>

  <div class="collapse navbar-collapse" id="basicExampleNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" onclick="displayTable()">Medicare Apllication Admin Page</a>
      </li>
    </ul>
    <form class="form-inline">
      <div class="md-form my-0">
        <a class="nav-link" href="logout.php" style="padding-left:5px;padding-right:5px;margin-left:0px;"> Logout </a>
      </div>
    </form>
  </div>
</nav>

<style>
  .navbar-nav {
    margin-left: auto;
  }
</style>

<script>
  function redirectToPHP() {
    window.location.href = "about.php";
  }
</script>