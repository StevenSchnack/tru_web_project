<!--Center Content-->
<div id="div-center-content" class="col-md-8 col-11 pt-2 p-1 align-items-center ">
    <form method="post" action="">
        <input type="hidden" name="page" value="main-page-quiz">
        <input type="hidden" name="command" value="quiz-submit">
        <h2 id="quiz-title" class="text-center">Quiz #1</h2>
        <!--Question 1-->
        <div class="question-content card">
            <div class="card-header text-bg-info">
                <h4>Question 1</h4>
            </div>
            <div class="card-body">
                <div class="card-title">
                    <p id="quiz-question-description">awdaawd</p>
                </div>
                <div class="card-text input-group">
                    <div class="row p-1 pt-2">
                        <div class="form-check">
                            <input id="quiz-option-1" class="form-check-input" type="radio" name="quiz-question-1"
                                value="A">
                            <label class="form-check-label" for="quiz-option-1">Option 1</label>
                        </div>
                        <div class="form-check">
                            <input id="quiz-option-2" class="form-check-input" type="radio" name="quiz-question-1"
                                value="B">
                            <label class="form-check-label" for="quiz-option-2">Option 2</label>
                        </div>
                        <div class="form-check">
                            <input id="quiz-option-3" class="form-check-input" type="radio" name="quiz-question-1"
                                value="C">
                            <label class="form-check-label" for="quiz-option-3">Option 3</label>
                        </div>
                        <div class="form-check">
                            <input id="quiz-option-4" class="form-check-input" type="radio" name="quiz-question-1"
                                value="D">
                            <label class="form-check-label" for="quiz-option-4">Option 4</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!--Submission Modal-->
<div id="modal-quiz-results" class="modal fade pt-5">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-success justify-content-center">
                <h1 class="modal-title">Results</h1>
            </div>
            <div class="modal-body text-center">
                <form method="" action="">
                    <input type="hidden" name="page" value="page-start">
                    <input type="hidden" name="command" value="page-start-signup">
                    <p>Score: <span>0</span></p>
                    <p>Percent: <span>0</span></p>
                    <p>Time: <span>0</span></p>
                </form>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-warning" value="Share">
                <input type="button" class="btn btn-primary" data-bs-dismiss="modal" value="Continue">
            </div>
        </div>
    </div>
</div>