// Escape text before putting it into an HTML string.
export function esc(value) {
  return String(value ?? "")
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#39;");
}

// Only allow "#" or full http(s) links. Anything else becomes "#".
export function safeUrl(url) {
  const u = String(url ?? "").trim();
  return u === "#" || /^https?:\/\//i.test(u) ? u : "#";
}