const player = new Plyr(".plyr", {
  controls: [
    "play-large",
    "play",
    "progress",
    "current-time",
    "duration",
    "mute",
    "volume",
    "captions",
    "settings",
    "pip",
    "fullscreen",
  ],
  seekTime: 10,
  disableContextMenu: false,
  tooltips: {
    controls: true,
  },
  keyboard: {
    focused: true,
    global: true,
  },
});

$(document).ready(function () {
  $(".section-header").on("click", function () {
    const content = $(this).next(".section-content");
    const toggleIcon = $(this).find(".toggle-icon");

    $(".section-content").not(content).slideUp();
    $(".section-header").not(this).removeClass("active");
    $(".toggle-icon")
      .not(toggleIcon)
      .removeClass("bi-chevron-up")
      .addClass("bi-chevron-down");

    content.slideToggle();
    $(this).toggleClass("active");
    toggleIcon.toggleClass("bi-chevron-down bi-chevron-up");
  });

  $(".section-content > ul > li").on("click", function (e) {
    const lessonTitle = $(e.target).closest("li").find(".lesson-title").text();
    console.log(lessonTitle);
    const videoName = $(e.target)
      .closest("li")
      .find(".duration")
      .data("video-url");
    var basePath = `${window.location.protocol}//${window.location.host}`;
    var fullLink = `/ewkethub_shared_assets/videos/lesson_videos/${videoName}`;
    $("source").attr("src", `${basePath}${fullLink}`);
    $("h2").text(`${$("h2").data("course-name")}: ${lessonTitle}`);

    player.source = {
      type: "video",
      sources: [
        {
          src: fullLink,
          type: "video/mp4",
        },
      ],
    };

    player.play();

    $(".section-content li").removeClass("active-lesson");
    $(this).addClass("active-lesson");
  });
  if ($(".main-title").data("paid") === false) {
    $(".section-content > ul > li").off();
  }

  $(".wishlist-button").on("click", () => {
    let mode = $(".bookmark")[0].classList[0].includes("plus")
      ? "add"
      : "remove";

    $.ajax({
      url: `/wishlist/${mode}`,
      method: "POST",
      data: {
        course_slug: $(".main-title").data("course-slug"),
      },
      dataType: "json",
      success: function (data) {
        if (data.success && mode === "add") {
          $(".wishlist-button").html(
            '<i class="bi-bookmark-dash-fill bi bookmark"></i> Remove from wishlist'
          );
          $(".message-widget").text("Course added to wishlist");
          $(".message-widget").addClass("success-widget");
          $(".message-widget").show();
        } else if (data.success && mode === "remove") {
          $(".wishlist-button").html(
            '<i class="bi-bookmark-plus-fill bi bookmark"></i> Add to wishlist'
          );
          $(".message-widget").text("Course removed from wishlist");
          $(".message-widget").addClass("success-widget");
          $(".message-widget").show();
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
