const quizData = [
    {
        question: "If you put an insect and a plant in airtight container, what can you expect to happen?",
        a: "Both will die instantly",
        b: "The insect will run out of air.",
        c: "The plant will run out of air.",
        d: "They use and release different types of air, so they should continue to live.",
        correct: "d",
    },
    {
        question: "What are the tiny tubes called inside the stem that bring water from the roots to the rest of the plant?",
        a: "Phloem",
        b: "Roots",
        c: "Xylem",
        d: "Inner Tubes",
        correct: "c",
    },
    {
        question: "Which of the following is NOT scientifically considered a fruit?",
        a: "Broccoli",
        b: "Tomato",
        c: "Pear",
        d: "Pumpkin",
        correct: "a",
    },
    {
        question: "What environmental condition might diminish plant growth?",
        a: "Breezy Day",
        b: "Cloudy Day",
        c: "Sunny Day",
        d: "Drought",
        correct: "d",
    },


];

  
  const quiz = document.getElementById("quiz");
  const answerEls = document.querySelectorAll(".answer");
  const questionEl = document.getElementById("question");
  const a_text = document.getElementById("a_text");
  const b_text = document.getElementById("b_text");
  const c_text = document.getElementById("c_text");
  const d_text = document.getElementById("d_text");
  const submitBtn = document.getElementById("submit");
  
  let currentQuiz = 0;
  let score = 0;
  
  loadQuiz();
  
  function loadQuiz() {
    deselectAnswers();
  
    const currentQuizData = quizData[currentQuiz];
  
    questionEl.innerText = currentQuizData.question;
    a_text.innerText = currentQuizData.a;
    b_text.innerText = currentQuizData.b;
    c_text.innerText = currentQuizData.c;
    d_text.innerText = currentQuizData.d;
  }
  
  function deselectAnswers() {
    answerEls.forEach((answerEl) => (answerEl.checked = false));
  }
  
  function getSelected() {
    let answer;
    answerEls.forEach((answerEl) => {
      if (answerEl.checked) {
        answer = answerEl.id;
      }
    });
    return answer;
  }
  
  submitBtn.addEventListener("click", () => {
    const answer = getSelected();
    if (answer) {
      if (answer === quizData[currentQuiz].correct) {
        score++;
      }
  
      currentQuiz++;
  
      if (currentQuiz < quizData.length) {
        loadQuiz();
      } else {
        quiz.innerHTML = `
             <h2>You answered ${score}/${quizData.length} questions correctly</h2>
  
             <button onclick="location.reload()">Reload</button>
             <a class="save-button" href="save-score.php?score=${score}">Save Score</a>
             `;
      }
    }
  });
  