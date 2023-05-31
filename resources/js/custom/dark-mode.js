const themeToggleDarkIcon = document.querySelector("#theme-toggle-dark-icon");
const themeToggleLightIcon = document.querySelector("#theme-toggle-light-icon");

const userTheme = localStorage.getItem("theme");
const systemTheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

const iconToggle = () => {
  themeToggleDarkIcon.classList.toggle('display-none');
  themeToggleLightIcon.classList.toggle('display-none');
}

const themeCheck = () => {
    if (userTheme === "dark" || (!userTheme && systemTheme)) {
        document.documentElement.classList.add('dark');
        themeToggleDarkIcon.classList.add('display-none');
        return;
    }
    themeToggleLightIcon.classList.add('display-none');
}

const themeSwitch = () => {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem("theme", "light");
        iconToggle();
        return;
    }
    document.documentElement.classList.add('dark');
    localStorage.setItem("theme", "dark");
    iconToggle();
}

themeToggleLightIcon.addEventListener("click", () => {
    themeSwitch();
});

themeToggleDarkIcon.addEventListener("click", () => {
    themeSwitch();
});

themeCheck();
