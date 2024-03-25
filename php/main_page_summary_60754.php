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
    <div class="card mb-3">
        <div class="card-header dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Select Quiz
            </button>
            <ul class="dropdown-menu">
                <li><button class="dropdown-item" type="button">Quiz #1</button></li>
            </ul>
        </div>
        <div class="card-body">
            <h4 class="row card-title justify-content-center">Quiz Title</h4>
            <div class="card-text ">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p class="d-inline float-start mb-0">Score:</p>
                        <p class="d-inline float-end mb-0">0</p>
                    </li>
                    <li class="list-group-item">
                        <p class="d-inline float-start mb-0">Percent:</p>
                        <p class="d-inline float-end mb-0">0</p>
                    </li>
                    <li class="list-group-item">
                        <p class="d-inline float-start mb-0">Time:</p>
                        <p class="d-inline float-end mb-0">0</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Overall Summary</h1>
        </div>
        <div class="card-body">
            <div class="card-text ">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item ">
                        <p class="d-inline float-start mb-0">Average Score:</p>
                        <p class="d-inline float-end mb-0">0</p>
                    </li>
                    <li class="list-group-item">
                        <p class="d-inline float-start mb-0">Average Percentage:</p>
                        <p class="d-inline float-end mb-0">0</p>
                    </li>
                    <li class="list-group-item">
                        <p class="d-inline float-start mb-0">Average Time:</p>
                        <p class="d-inline float-end mb-0">0</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>