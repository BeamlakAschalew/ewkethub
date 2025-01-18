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
    const videoName = $(e.target)
      .closest("li")
      .find(".duration")
      .data("video-url");
    const fullLink = `../../assets/videos/${videoName}`;
    $("source").attr("src", fullLink);
    $("h1").text(lessonTitle);

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
  });
});
