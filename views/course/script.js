const player = new Plyr(".plyr");

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
});
