        <!--Center Content-->
        <div id="div-center-content" class="col-md-8 col-11 pt-5 p-5 align-self-center text-center">
            <h2 id="start-welcome-text" class="pt-4 p-2">Welcome, Username!</h2>
            <div id="button-start-quiz" class="btn btn-primary btn-lg" type="button">Start Quiz</div>
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
                    <button id="button-submit-quiz" class="btn btn-success" type="submit" value="Submit">Submit</button>
                    <button id="button-save-quiz" class="btn btn-primary btn-sm" type="button" value="Save">Save for
                        Later</button>
                </div>
            </div>
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
    </div>


</body>

</html>
<script>

    $('#button-submit-quiz').click(function () {
        $('#modal-quiz-results').modal('show');
    });
    
</script>
