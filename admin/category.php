<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="Css/category.css">
</head>

<body>
    <div class="container">
        <div class="buttonContainer">
            <button id="semesterButton" data-completed="false">Semester</button>
            <button id="categoryButton" data-completed="false">Category</button>
            <button id="questionnaireButton" data-completed="false">Questionnaire</button>
        </div>
        <div class="tabPanel" id="semesterPanel">
            Semester: Content
            <button id="nextToCategory" class="nextButton">Next</button>
        </div>
        <div class="tabPanel" id="categoryPanel">
            Category: Content
            <button id="nextToQuestionnaire" class="nextButton">Next</button>
        </div>
        <div class="tabPanel" id="questionnairePanel">Questionnaire: Content</div>
    </div>


</body>
<script>
    document.addEventListener("DOMContentLoaded", () => {
  const semesterButton = document.getElementById("semesterButton");
  const categoryButton = document.getElementById("categoryButton");
  const questionnaireButton = document.getElementById("questionnaireButton");

  const semesterPanel = document.getElementById("semesterPanel");
  const categoryPanel = document.getElementById("categoryPanel");
  const questionnairePanel = document.getElementById("questionnairePanel");

  const nextToCategoryButton = document.getElementById("nextToCategory");
  const nextToQuestionnaireButton = document.getElementById(
    "nextToQuestionnaire"
  );

  const hideAllPanels = () => {
    semesterPanel.style.display = "none";
    categoryPanel.style.display = "none";
    questionnairePanel.style.display = "none";
  };

  semesterButton.addEventListener("click", () => {
    hideAllPanels();
    semesterPanel.style.display = "block";
    categoryButton.disabled = false;
    semesterButton.classList.add("active");
    categoryButton.classList.remove("active");
    questionnaireButton.classList.remove("active");
  });

  nextToCategoryButton.addEventListener("click", () => {
    hideAllPanels();
    categoryPanel.style.display = "block";
    categoryButton.classList.add("active");
    semesterButton.classList.remove("active");
    questionnaireButton.classList.remove("active");
  });

  nextToQuestionnaireButton.addEventListener("click", () => {
    hideAllPanels();
    questionnairePanel.style.display = "block";
    questionnaireButton.classList.add("active");
    semesterButton.classList.remove("active");
    categoryButton.classList.remove("active");
  });

  categoryButton.addEventListener("click", () => {
    hideAllPanels();
    categoryPanel.style.display = "block";
    categoryButton.classList.add("active");
    semesterButton.classList.remove("active");
    questionnaireButton.classList.remove("active");
  });

  questionnaireButton.addEventListener("click", () => {
    hideAllPanels();
    questionnairePanel.style.display = "block";
    questionnaireButton.classList.add("active");
    semesterButton.classList.remove("active");
    categoryButton.classList.remove("active");
  });

  hideAllPanels();
  semesterPanel.style.display = "block";
});

</script>
</html>
