$(document).ready(function () {
  $(".menu-icon").on("click", function (event) {
    toggleMenu(event);
  });

  $(window).on("resize", function () {
    showMenuOnResize();
  });

  const form = $("form");
  form.submit(function (e) {
    e.preventDefault;
    const term = $(".search-input").val();
    if (term !== "") {
      form.attr("action", `/search/${term}`);
      form.off("submit").submit();
    }
  });

  $("#searchInput").on("input", function () {
    const query = $(this).val();
    fetchSearchResults(query);
  });

  $(document).on("click", function (event) {
    if (!$(event.target).closest(".search-bar").length) {
      $("#liveSearchResults").hide();
    }
  });
});

function toggleMenu(event) {
  event.preventDefault();
  let currentState = $(".menu-icon").attr("class").split(" ")[2];
  if (currentState === "bi-list") {
    openMenu();
  } else {
    closeMenu();
  }
}

function openMenu() {
  $(".search-bar").css({ display: "flex" });
  $(".main-navigation").css({ display: "flex" });
  $(".menu-icon").addClass("bi-x-lg");
  $(".menu-icon").removeClass("bi-list");
}

function closeMenu() {
  $(".search-bar").css({ display: "none" });
  $(".main-navigation").css({ display: "none" });
  $(".menu-icon").removeClass("bi-x-lg");
  $(".menu-icon").addClass("bi-list");
}

function showMenuOnResize() {
  if ($(window).width() > 577) {
    $(".search-bar").css({ display: "flex" });
    $(".main-navigation").css({ display: "flex" });
  }

  let currentState = $(".menu-icon").attr("class").split(" ")[2];

  if ($(window).width() < 577 && currentState === "bi-list") {
    $(".search-bar").css({ display: "none" });
    $(".main-navigation").css({ display: "none" });
  }
}

function fetchSearchResults(query) {
  console.log("invoked");
  if (query.trim() === "") {
    $("#liveSearchResults").hide();
    return;
  }

  $.ajax({
    url: `/live/${query}`,
    method: "GET",
    dataType: "json",
    success: function (data) {
      const resultsContainer = $("#liveSearchResults");
      resultsContainer.empty();

      console.log(data);

      if (data.courses.length || data.categories.length) {
        $("#liveSearchResults").show();
        data.courses.forEach((course) => {
          resultsContainer.append(`
            <a href="/course/${course.course_slug}">
              <div class="result-item">
                <strong>${course.name}</strong> <br>
                <span>${course.description}</span>
              </div>
            </a>
          `);
        });

        $("#liveSearchResults").show();
        if (data.categories.length) {
          resultsContainer.append(
            '<div class="category-title">Categories</div>'
          );
          data.categories.forEach((category) => {
            resultsContainer.append(`
            <a href="/category/${category.slug}">
              <div class="result-item">${category.name}</div>
            </a>
            `);
          });
        }
      } else {
        resultsContainer.append(
          '<div class="result-item">No results found</div>'
        );
        resultsContainer.show();
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching search results:", error);
    },
  });
}
