import "./bootstrap";

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

// resources/js/app.js
function trackClick(slug) {
    const token = document.querySelector('meta[name="csrf-token"]').content;
    fetch("/clicks", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
        keepalive: true, // lader request køre når siden navigerer væk
        body: JSON.stringify({ slug }),
    }).catch(() => {});
}

// auto-bind alle links til indlæg
document.addEventListener("click", (e) => {
    const a = e.target.closest("a[href]");
    if (!a) return;
    // justér match så den passer til dine ruter
    if (a.href.includes("/insights/")) {
        const slug = a.href.split("/").pop();
        trackClick(slug);
    }
});
