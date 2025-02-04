$(document).ready(function () {
  $(".bookmark-btn").on("click", function (e) {
    let clickedWidget = this;
    e.stopPropagation();
    e.preventDefault();
    $.ajax({
      url: `/wishlist/remove`,
      method: "POST",
      data: {
        course_slug: $(".bookmark-btn").data("course-slug"),
      },
      dataType: "json",
      success: function (data) {
        if (data.success) {
          $(".message-widget").text("Course removed from wishlist");
          $(".message-widget").addClass("success-widget");
          $(".message-widget").show();
          location.reload();
        } else if (!data.success) {
          $(".message-widget").text(`Failed to ${mode} the course`);
          $(".message-widget").removeClass("success-widget error-widget");
          $(".message-widget").addClass("error-widget");
          $(".message-widget").show();
        }

        setTimeout(() => {
          $(".message-widget").hide();
        }, 3000);
      },
      error: function (xhr, status, error) {
        console.error("Error in wishlist:", error);
      },
    });
  });
});
