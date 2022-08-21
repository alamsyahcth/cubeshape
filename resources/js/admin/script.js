let BASE_URL = window.location.origin;

function startTimer(duration, display) {
  var timer = duration, minutes, seconds;
  let interval;

  interval = setInterval(function () {
    minutes = parseInt(timer / 60, 10)
    seconds = parseInt(timer % 60, 10);

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display.text(minutes + ":" + seconds);

    if (--timer < 0) {
      actionSubmitQuiz();
      clearInterval(interval);
      timer = 0;
    }
  }, 1000);
}

jQuery(function ($) {
  var fiveMinutes = $('#limitTime').val(),
  display = $('#time');
  startTimer(fiveMinutes, display);
});

function quizStep() {
  var index = $(".step.active").index(".step"),
    stepsCount = $(".step").length,
    prevBtn = $(".prev"),
    nextBtn = $(".next"),
    activeCount = 1;
    flag = 1;

  prevBtn.click(function () {
    nextBtn.prop("disabled", false);

    if (index > 0) {
      index--;
      $(".step").removeClass("active").eq(index).addClass("active");
    };

    if (index === 0) {
      $(this).prop("disabled", true);
    }

    flag = flag - 1;

    $('.activeIndex').html(activeCount + index);
    $('.countIndex').html(stepsCount);

  });

  nextBtn.click(function () {
    prevBtn.prop("disabled", false);

    if (index < stepsCount - 1) {
      index++;
      let chooseAnswer = $('.next.next-' + index).find('input').attr('name');
      let dataOption = $(this).data('id');
      localStorage.setItem(chooseAnswer, dataOption);
      $(".step").removeClass("active").eq(index).addClass("active");
    };

    if (index === stepsCount - 1) {
      $(this).prop("disabled", true);
    }

    if (flag > stepsCount) {
      flag = stepsCount + 1;
    } else {
      flag++;
    }

    $('.activeIndex').html(activeCount + index);
    $('.countIndex').html(stepsCount);

    if (flag > stepsCount) {
      $('#quizSubmit').modal('show');
    }
    // console.log(`activeCount = ${activeCount}, stepCount = ${stepsCount}, and index = ${index}, flag = ${flag}`);
  });

  $('.activeIndex').html(activeCount);
  $('.countIndex').html(stepsCount);
}

function setActiveAnswer() {
  $('.step').each(function (index) {
    let dataAnswer = localStorage.getItem('option-' + index);
    $('#' + dataAnswer).prop('checked', true);
  });
}

function closeModal() {
  $('.close-modal').click(function() {
    $('.modal').modal('hide');
  })
}

function handleOption() {
  $(".option").change(function () {
    $(".option").prop('checked', false);
    $(this).prop('checked', true);
    let chooseId = $(this).attr('id');
    let id = chooseId.slice(chooseId.length - 1);
    $('.option-question').val(0);
    $('#option-' + id).val(1);
  });

  $(".option-update").change(function () {
    $(".option-update").prop('checked', false);
    $(this).prop('checked', true);
    let chooseId = $(this).attr('id');
    let id = chooseId.slice(chooseId.length - 1);
    $('.option-update-question').val(0);
    $('#option-update-' + id).val(1);
  });
}

$(document).on('click', '.edit-question',function(e) {
  e.preventDefault();
  $('#updateQuestionOption').modal('show');
  $('.questionId').val($(this).data('id'));
  $('.quizId').val($(this).data('quizid'));
  $('.questionTitle').val($(this).data('title'));

  $.ajax({
    method: 'get',
    url: BASE_URL + '/admin/quiz/questions/get-question-option/' + $(this).data('id'),
    dataType: 'json',
    success: function(res) {
      console.log(res.data);
      res.data.map((val, index) => {
        $('.questionId-' + index).val(val.id);
        $('.questionOption-' + index).val(val.option);
        $('.questionAnswer-' + index).val(val.is_true);
        if (val.is_true === 1) {
          $('#choose-update-' + index).prop('checked', true);
        }
      });
    }
  })
});

function handleCopyPIN() {
  $(document).on('click', '.btn-copy', function() {
    value = $(this).data('pin');

    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(value).select();
    document.execCommand("copy");
    $temp.remove();
  });
}

function actionSubmitQuiz() {
  let values = 0;
  let add = 0;
  
  let ipAddress = '127.0.0.1';
  let socketPort = '3000';
  let socket = io(ipAddress + ':' + socketPort);

  $('.step').each(function(index) {
    if (Number.isNaN(parseInt($(`input:radio[name='option-${index}']:checked`).val()))) {
      add = 0;
    } else {
      add = parseInt($(`input:radio[name='option-${index}']:checked`).val());
    }
    values = values + add;
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: 'post',
    url: BASE_URL + '/store-question',
    data: {
      score: values
    }, success: function(res) {
      $('.step').each(function (index) {
        localStorage.removeItem('option-' + index);
      });
      window.location.replace(`${BASE_URL}/result`);
    }
  });
}

function submitQuiz() {
  $('#submitQuiz').on('click', function() {
    actionSubmitQuiz();
  });
}

function socket() {
  let ipAddress = '127.0.0.1';
  let socketPort = '3000';
  let socket = io(ipAddress +':'+ socketPort);

  $(document).on('click', '#startQuiz', function(e) {
    e.preventDefault();
    socket.emit('setActiveQuizServer', 'start quiz active');
    window.location.replace($(this).data('url'));
  });

  socket.on('setActiveQuizClient', (message) => {
    $('#start-quiz-waiting').removeClass('d-block');
    $('#start-quiz-waiting').addClass('d-none');
    $('#start-quiz-show').removeClass('d-none');
    $('#start-quiz-show').addClass('d-block');
  });
}

$(document).ready(function () {
  $('.step-1').addClass('active');
  $('.dataTable').DataTable();
  quizStep();
  closeModal();
  handleOption();
  handleCopyPIN();
  submitQuiz();
  setActiveAnswer();
  socket();
});