<!--Center Content-->
<div class="summary-content">
    <h2 id="summary-username" class="text-center p-5">
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            echo ($_SESSION['username']);
        } else {
            echo "Guest";
        }
        ?>
    </h2>
    <div class="card">
        <div class="card-header">
            <h4>Overall Summary</h1>
        </div>
        <div class="card-body">
            <div class="card-text ">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item ">
                        <p class="d-inline float-start mb-0">Average Score:</p>
                        <p id="summary-average-score"class="d-inline float-end mb-0">0</p>
                    </li>
                    <li class="list-group-item">
                        <p class="d-inline float-start mb-0">Average Percentage:</p>
                        <p id="summary-average-percent" class="d-inline float-end mb-0">0</p>
                    </li>
                    <li class="list-group-item">
                        <p class="d-inline float-start mb-0">Average Time:</p>
                        <p id="summary-average-time" class="d-inline float-end mb-0">0</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>