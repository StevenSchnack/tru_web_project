            <div class="profile-content">
                <h2 id="profle-username" class="text-center p-5">
                    <?php
                    session_start();
                    if (isset($_SESSION['username'])) {
                        echo ($_SESSION['username']);
                    } else {
                        echo "Guest";
                    }
                    ?>
                </h2>
                <form id="form-change-profile" method="post" action="controller_60754.php">
                    <input type="hidden" name="page" value="page-main">
                    <input type="hidden" name="command" value="change-profile">
                    <ul class="list-group list-group-flush rounded-0">
                        <li class="list-group-item" style="padding-bottom: 10px;">
                            <p class="d-inline float-start">Email:</p>
                            <p id="profile-current-email" class="d-inline float-end"></p>
                        </li>
                        <li class="list-group-item pt-4">
                            <label class="d-inline float-start">Change Email</label>
                            <input class="d-inline float-end" name="new-email" type="email" placeholder="Enter New Email" />
                        </li>
                        <li class="list-group-item pt-4">
                            <label class="d-inline float-start">Change Password</label>
                            <input class="d-inline float-end" name="new-password" type="password" placeholder="Enter New Password" pattern="^[A-Z].{4,19}$"/>
                            <br><br>
                            <p class="text-end">Password must start with an <u>uppercase</u> letter</p>
                            <p class="text-end">Password must be <u>5-20</u> characters long</p>
                        </li>
                        <li class="list-group-item pt-4 form-check form-switch align-self-center">
                            <label class="d-inline form-check-label" for="switch-set-reminder">Set Email Reminder</label>
                            <input id="profile-set-reminder" name="set-reminder" class="d-inline form-check-input" type="checkbox" role="switch">
                        </li>
                    </ul>
                    <div class="row justify-content-center pt-5">
                        <div class="col col-auto text-center">
                            <button id="button-delete-user" type="button" class="btn btn-danger">Delete Account</button>
                            <button id="button-cancel-changes" type="reset" class="btn btn-secondary">Cancel</button>
                            <button id="button-apply-changes" type="submit" class="btn btn-success">Apply Changes</button>
                        </div>
                    </div>
                </form>
            </div>