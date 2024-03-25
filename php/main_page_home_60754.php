        <!--Center Content-->
        <div id="div-home-content" class="text-center pt-4">
            <h2 id="start-welcome-text" class="pt-4 p-2">
                <?php
                session_start();
                if (isset($_SESSION['username'])) {
                    echo "Welcome, " . ($_SESSION['username']);
                } else {
                    echo "Guest";
                }
                ?>!
            </h2>
            <div id="button-start-quiz" class="btn btn-primary btn-lg" type="button" onclick="startTimer()">Start Quiz</div>
        </div>