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
                <ul class="list-group list-group-flush rounded-0">
                    <li class="list-group-item" style="padding-bottom: 10px;">
                        <p class="d-inline float-start">Email:</p>
                        <p class="d-inline float-end">myemail@email.com</p>
                    </li>
                    <li class="list-group-item pt-4">
                        <label class="d-inline float-start">Change Email</label>
                        <input class="d-inline float-end" type="email" placeholder="Enter New Email" />
                    </li>
                    <li class="list-group-item pt-4">
                        <label class="d-inline float-start">Change Password</label>
                        <input class="d-inline float-end" type="password" placeholder="Enter New Password" />
                    </li>
                    <li class="list-group-item pt-4 form-check form-switch align-self-center">
                        <label class="d-inline form-check-label" for="switch-set-reminder">Set Email Reminder</label>
                        <input id="switch-set-reminder" class="d-inline form-check-input" type="checkbox" role="switch">
                    </li>
                </ul>
                <div class="row justify-content-center pt-5">
                    <div class="col col-auto text-center">
                        <button id="button-delete-account" class="btn btn-danger">Delete Account</button>
                        <button id="button-cancel-changes" class="btn btn-secondary">Cancel</button>
                        <button id="button-apply-changes" class="btn btn-success">Apply Changes</button>
                    </div>
                </div>
            </div>