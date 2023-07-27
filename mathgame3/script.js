var expr = "1 + 1";
var expr_answer = 2;
var signs = "+×÷-".split("");
var difficulty = 1;
var diff_floor = true;
var points = 0;
var num = 0;
var time = 120;
var did_expr = 0;

function update_expr(smth) {
  $(".expression").text(smth);
}

function floor(num) {
  if (diff_floor) {
    return Math.floor(num);
  } else {
    return num.toFixed(1);
  }
}

function gen_expr() {
  num++;
  var left = floor(Math.random() * 7 + 5 * difficulty);
  var right = floor(Math.random() * 7 + 5 * difficulty);
  var sign = signs[Math.floor(Math.random() * signs.length)];

  expr = left + " " + sign + " " + right;

  switch (sign) {
    case "+":
      expr_answer = left + right;
      break;
    case "×":
      expr_answer = left * right;
      break;
    case "÷":
      expr_answer = Math.floor(left / right);
      break;
    case "-":
      expr_answer = left - right;
      break;
  }
  update_expr(expr);
  $(".number").text("#" + num);
  did_expr++;
}

var intr = 0;
var user_id = $("input[type=hidden][name=user_id]").val();
var game_type = $("input[type=hidden][name=game_type]").val();
// Sent points to database
function done() {
  clearInterval(intr);
  $(".number").fadeOut(100);
  $(".time").fadeOut(100);
  $(".expression, input").fadeOut(100);
  $(".done")
    .text(
      "Done. You solved " +
        did_expr +
        " expressions and got " +
        points +
        " points."
    )
    .fadeIn(100);
  $(".save-score").show();

  $("input[type=hidden][name=user_id]").attr("value", user_id);
  $("input[type=hidden][name=game_type]").attr("value", game_type);
  $("#game-score").attr("value", points);
  $("input[type=submit][name=submit]").attr("value", "Save Score");
  $("input[type=submit][name=submit]").show();
}
function begin() {
  gen_expr();
  var intr = setInterval(function () {
    time--;
    if (time <= 0) {
      // done.
      done();
    }
    $(".time").text(time);
  }, 1000);
}
$(function () {
  $(".done, .expression, input, .number, .time").hide();
  $("button").click(function () {
    $(".done, .expression, input, .number, .time").fadeIn(100);
    $(this).hide();
    begin();
  });
});

$("input").on("keyup", function () {
  var entered = $("input").val();

  if (expr_answer === parseInt(entered, 10)) {
    $("input").val("");
    points += Math.floor(500 + Math.random() * 200);
    $(".segment#points").text("Points: " + points);
    gen_expr();
  }
});
