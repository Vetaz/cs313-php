function toggleDarkMode() {
  if (document.getElementById("dark").rel == "stylesheet") {
    document.getElementById("dark").rel = "dark.css";
  } else {
    document.getElementById("dark").rel = "stylesheet";
  }
}