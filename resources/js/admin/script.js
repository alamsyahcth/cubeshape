let BASE_URL = window.location.origin;

function startTimer(duration, display) {
  var timer = duration, minutes, seconds;
  setInterval(function () {
    minutes = parseInt(timer / 60, 10)
    seconds = parseInt(timer % 60, 10);

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display.text(minutes + ":" + seconds);

    if (--timer < 0) {
      timer = 0;
    }
  }, 1000);
}

jQuery(function ($) {
  var fiveMinutes = 60 * 5,
  display = $('#time');
  startTimer(fiveMinutes, display);
});

function quizStep() {
  var index = $(".step.active").index(".step"),
    stepsCount = $(".step").length,
    prevBtn = $(".prev"),
    nextBtn = $(".next");
    activeCount = 1;

  prevBtn.click(function () {
    nextBtn.prop("disabled", false);

    if (index > 0) {
      index--;
      $(".step").removeClass("active").eq(index).addClass("active");
    };

    if (index === 0) {
      $(this).prop("disabled", true);
    }

    $('.activeIndex').html(activeCount + index);
    $('.countIndex').html(stepsCount);

  });

  nextBtn.click(function () {
    prevBtn.prop("disabled", false);

    if (index < stepsCount - 1) {
      index++;
      $(".step").removeClass("active").eq(index).addClass("active");
    };

    if (index === stepsCount - 1) {
      $(this).prop("disabled", true);
    }

    $('.activeIndex').html(activeCount + index);
    $('.countIndex').html(stepsCount);
  });

  $('.activeIndex').html(activeCount);
  $('.countIndex').html(stepsCount);
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

$(document).ready(function () {
  $('.step-1').addClass('active');
  $('.dataTable').DataTable();
  quizStep();
  closeModal();
  handleOption();
  handleCopyPIN();
});