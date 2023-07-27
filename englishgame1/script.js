const quizData = [
  {
    question: "Which sentence is correct?",
    a: "They saw roses, lilies, and tulips in the garden.",
    b: "They saw roses lilies, and tulips in the garden.",
    c: "They saw roses, lilies, tulips in the garden.",
    d: "They saw roses lilies and tulips in the garden.",
    correct: "a",
  },
  {
    question: "Which sentence is correct?",
    a: "Her favorite sports are soccer tennis and hockey.",
    b: "Her favorite sports are soccer, tennis, and, hockey.",
    c: "Her favorite sports are soccer tennis, and hockey.",
    d: "Her favorite sports are soccer, tennis, and hockey.",
    correct: "d",
  },
  {
    question: "Which sentence is correct?",
    a: "There were guitars, drums, and violins in the band",
    b: "There were guitars, drums, and, violins in the band",
    c: "There were guitars drums and violins in the band",
    d: "There were guitars, drums and violins in the band",
    correct: "a",
  },
  {
    question: "Which sentence is correct?",
    a: "There were frogs, lizards, and snakes near the pond",
    b: "There were frogs, lizards and snakes near the pond",
    c: "There were frogs, lizards, and, snakes near the pond",
    d: "There were frogs lizards and snakes near the pond",
    correct: "a",
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
