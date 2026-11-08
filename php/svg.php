<?php
// Checks that "inner SVG" markup (what goes inside <svg>...</svg>)
// only contains simple drawing shapes. Returns an error message, or null if OK.
function check_svg_inner(string $inner): ?string {
  $allowedTags  = ["path", "circle", "rect", "ellipse", "line", "polyline", "polygon", "g"];
  $allowedAttrs = ["d", "cx", "cy", "r", "rx", "ry", "x", "y", "x1", "y1", "x2", "y2",
                   "width", "height", "points", "transform"];

  $prev = libxml_use_internal_errors(true);
  $doc  = new DOMDocument();
  $ok   = $doc->loadXML('<svg xmlns="http://www.w3.org/2000/svg">' . $inner . '</svg>', LIBXML_NONET);
  libxml_clear_errors();
  libxml_use_internal_errors($prev);

  if (!$ok) return 'Icon markup is not valid. Every tag must be closed, e.g. <path d="..."/>.';

  $walk = function (DOMNode $parent) use (&$walk, $allowedTags, $allowedAttrs): ?string {
    foreach ($parent->childNodes as $child) {
      if ($child->nodeType === XML_TEXT_NODE && trim($child->nodeValue) === "") continue;
      if ($child->nodeType !== XML_ELEMENT_NODE) return "Icon can only contain drawing tags.";
      if (!in_array($child->localName, $allowedTags, true)) {
        return "Icon can only use these tags: " . implode(", ", $allowedTags) . ".";
      }
      foreach ($child->attributes as $attr) {
        if (!in_array($attr->name, $allowedAttrs, true)) {
          return 'The attribute "' . $attr->name . '" is not allowed in the icon.';
        }
      }
      if ($err = $walk($child)) return $err;
    }
    return null;
  };

  return $walk($doc->documentElement);
}