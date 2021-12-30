/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$(document.body).on("change", "#challenged_dropdown", function () {
  var selected = $(this).children("option:selected").val();
  if (selected == "yes") {
    document.getElementById("challenged2").style.display = "block";
    return;
  }
  document.getElementById("challenged2").style.display = "none";
});

$(document.body).on("change", "#modeofentry", function () {
  var selected = $(this).children("option:selected").val();
  if (selected == "de") {
    document.getElementById("de_div").style.display = "block";
    document.getElementById("diploma_file").style.display = "block";
    return;
  }
  document.getElementById("de_div").style.display = "none";
  document.getElementById("diploma_file").style.display = "none";
});

$(document.body).on("change", "#qualification", function () {
  var selected = $(this).children("option:selected").val();
  if (selected == "olevel") {
    document.getElementById("degree_file").style.display = "none";
    document.getElementById("diploma_file").style.display = "none";
  } else if (selected == "diploma") {
    document.getElementById("diploma_file").style.display = "block";
    document.getElementById("degree_file").style.display = "none";
  } else if (selected == "degree") {
    document.getElementById("diploma_file").style.display = "none";
    document.getElementById("degree_file").style.display = "block";
  }
});

function payWithPaystack() {
  $.LoadingOverlay("show");
  var amount = document.getElementById("amount").value;
  var mail = document.getElementById("email").value;
  var applicant_id = document.getElementById("applicant_id").value;
  var currency = document.getElementById("currency").value;
  var reference = document.getElementById("reference").value;

  //createTransaction(reference, amount, applicant_id);

  var handler = PaystackPop.setup({
    key: "pk_test_e2fc375cd0bdd40a6be1c81a619cab8f5e856b3a",
    email: mail,
    amount: amount * 100,
    ref: "" + Math.floor(Math.random() * 1000000000 + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    metadata: {
      custom_fields: [
        {
          applicant_id: applicant_id,
          amountPaid: amount,
          ref: reference,
        },
      ],
    },
    callback: function (response) {
      //alert("success. transaction ref is " + response.reference);
      $.LoadingOverlay("show");
      updateTransaction(response.reference);
    },
    onClose: function () {
      alert("window closed");
    },
  });
  handler.openIframe();
  $.LoadingOverlay("hide");
}

function createTransaction(reference, amount, applicant_id) {
  let _token = $('meta[name="csrf-token"]').attr("content");
  $.ajax({
    url: "/pay",
    type: "POST",
    data: {
      ref: reference,
      amount: amount,
      applicant_id: applicant_id,
      _token: _token,
    },
    success: function (response) { },
  });
}

function updateTransaction(reference) {
  let _token = $('meta[name="csrf-token"]').attr("content");
  $.ajax({
    url: "/payment/callback",
    type: "POST",
    data: {
      ref: reference,
      _token: _token,
    },
    success: function (response) {
      var result = jQuery.parseJSON(response);
      if (result) {
        window.location.reload();
      } else {
        document.getElementById('display-error').style.display = "block";
      }
    },
  });
}



$(document.body).on("change", "#customFile", function () {
  var fileName = $(this).val();
  //replace the "Choose a file" label
  $(this).next('.custom-file-input').html(fileName);
});


$(document.body).on("change", "#country_id", function () {
  var id = $(this).val();
  // Empty the dropdown
  $('#state_id').find('option').not(':first').remove();
  $.ajax({
    url: '../get-state/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {
      var len = 0;
      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >
        for (var i = 0; i < len; i++) {
          var id = response['data'][i].id;
          var name = response['data'][i].name;
          var option = "<option value='" + id + "'>" + name + "</option>";
          $("#state_id").append(option);
        }
      }

    }
  });
});

$(document.body).on("change", "#level", function () {
  var id = $(this).val();
  this.form.submit();
});

$(document).on('click', '.decline', function () {
  var email = $('#user_email').val();
  $('#declineCourseModal').modal('show');
  $('#demail').val(email);
});

$(document.body).on("change", "#state_id", function () {
  var id = $(this).val();
  // Empty the dropdown
  $('#city_id').find('option').not(':first').remove();
  $.ajax({
    url: '../get-city/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {
      var len = 0;
      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >
        for (var i = 0; i < len; i++) {
          var id = response['data'][i].id;
          var name = response['data'][i].name;
          var option = "<option value='" + id + "'>" + name + "</option>";
          $("#city_id").append(option);
        }
      }

    }
  });
});


$(document.body).on("change", "#faculty_id", function () {
  var id = $(this).val();
  // Empty the dropdown
  $('#course').find('option').not(':first').remove();
  $.ajax({
    url: '../departments/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {
      var len = 0;
      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >
        for (var i = 0; i < len; i++) {
          var id = response['data'][i].id;
          var name = response['data'][i].department_name;
          var option = "<option value='" + id + "'>" + name + "</option>";
          $("#course").append(option);
        }
      }

    }
  });
});


$(document.body).on("change", "#course", function () {
  var id = $(this).val();
  // Empty the dropdown
  $('#course_id').find('option').not(':first').remove();
  $.ajax({
    url: '../programmes/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {
      var len = 0;
      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >
        for (var i = 0; i < len; i++) {
          var id = response['data'][i].id;
          var name = response['data'][i].class_number;
          var option = "<option value='" + id + "'>" + name + "</option>";
          $("#course_id").append(option);
        }
      }

    }
  });
});


$(document.body).on("change", "#course_id", function () {
  var id = $(this).val();
  $.ajax({
    url: '../programmes-duration/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {
      var len = 0;
      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        var duration = response['data'][0].duration;
        $("#duration").val(duration);
      }
    }
  });
});

$(document.body).on("change", "#sitting", function () {
  var id = $(this).val();
  if (id == 2) {
    document.getElementById("2nd").style.display = "block";
  } else {
    document.getElementById("2nd").style.display = "none";
  }
});

$(document).on('show.bs.modal', '.modal', function () {
  $(this).appendTo('body');
});

function getTeacher(code1, code2) {
  var id = $('#' + code1).val();
  // Empty the dropdown
  $('#' + code2).find('option').not(':first').remove();
  $.ajax({
    url: '../teaching/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {
      var len = 0;
      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >
        for (var i = 0; i < len; i++) {
          var id = response['data'][i].id;
          var name = response['data'][i].name;
          var option = "<option value='" + id + "'>" + name + "</option>";
          $('#' + code2).append(option);
        }
      }

    }
  });
}
