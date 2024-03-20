        <!--Left Content-->
        <div class="col-md-2"></div>
        <div id="div-left-content" class="col-md-2 col-auto align-self-center text-center d-none d-sm-block">
            <div class="list-group flex-md-column flex-row rounded-0">
                <button type="button" class="list-group-item list-group-item-action">Home</button>
                <button type="button" class="list-group-item list-group-item-action active">Profile</button>
                <button type="button" class="list-group-item list-group-item-action">Summary</button>
                <button type="button" class="list-group-item list-group-item-action">Leaderboard</button>
                <button type="button" class="list-group-item list-group-item-action bg-warning">Logout</button>
            </div>
        </div>

        <!--Left Content Small-->
        <div id="div-left-content-sm" class="col-12 d-sm-none text-center">
            <div class="list-group">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="list-group-item list-group-item-action">Home</button>
                        <button type="button" class="list-group-item list-group-item-action active">Profile</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="list-group-item list-group-item-action">Summary</button>
                        <button type="button" class="list-group-item list-group-item-action">Leaderboard</button>
                    </div>
                    <div class="col-3 mx-auto">
                        <button type="button" class="list-group-item list-group-item-action bg-warning ">Logout</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Center Content-->
        <div id="div-center-content" class="col-md-7 col-12 pt-2 p-1 d-flex flex-column align-items-center justify-content-center" style="">

            <div class="profile-content">
                <h2 id="profle-username" class="text-center p-5">Username</h2>
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

        </div>

        <!--Right Content-->
        <div class="col-md-2"></div>
        <div id="div-right-content" class="text-center col-md-2 col-auto">
            <div class="container p-2 border rounded mx-auto">
                <div class="row mx-auto border pt-1 text-bg-primary rounded" style="width: 100%;">
                    <h5>Quiz Progress</h5>
                </div>
                <div class="row mx-auto">
                    <p>Answered: </p>
                </div>
                <div class="row mx-auto">
                    <p>Time: </p>
                </div>
                <div class="row gap-2 mx-auto">
                    <button class="btn btn-success" type="submit" value="Submit">Submit</button>
                    <button class="btn btn-primary btn-sm" type="button" value="Save">Save for Later</button>
                </div>
            </div>
        </div>
        </div>