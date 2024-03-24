<div class="container p-2 border rounded mx-auto">
    <div class="row mx-auto border pt-1 text-bg-primary rounded" style="width: 100%;">
        <h5>Quiz Progress</h5>
    </div>
    <div class="row mx-auto">
        <p id="right-content-answered">Answered: 0/10</p>
    </div>
    <div class="row mx-auto">
        <p id="right-content-timer">Time: 0:00</p>
    </div>
    <div id="nav-buttons-right" class="row gap-2 mx-auto">
        <button id="button-submit-quiz" class="btn btn-success" type="button" value="Submit" onclick="resetTimer()" disabled>Submit</button>
        <button id="button-save-quiz" class="btn btn-primary btn-sm" type="button" value="Save" onclick="stopTimer()" disabled>Save for Later</button>
    </div>
</div>