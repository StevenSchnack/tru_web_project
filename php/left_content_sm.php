<div id="nav-buttons-left" class="list-group">
    <div class="row">
        <div class="col-6">
            <button id="nav-button-home" type="button" class="list-group-item list-group-item-action active">Home</button>
            <button id="nav-button-profile" type="button" class="list-group-item list-group-item-action">Profile</button>
        </div>
        <div class="col-6">
            <button id="nav-button-summary" type="button" class="list-group-item list-group-item-action">Summary</button>
            <button id="nav-button-leaderboard" type="button" class="list-group-item list-group-item-action">Leaderboard</button>
        </div>
        <div class="col-3 mx-auto">
            <form id="form-signout" method="post" action="controller_60754.php">
                <input type="hidden" name="page" value="page-main">
                <input type="hidden" name="command" value="signout">
                <button id="nav-button-logout" type="submit" class="list-group-item list-group-item-action bg-warning">Logout</button>
            </form>
        </div>
    </div>
</div>