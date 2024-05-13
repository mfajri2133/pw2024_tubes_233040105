const linkElement = document.createElement("link");
linkElement.rel = "stylesheet";
linkElement.href =
     "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css";
linkElement.integrity =
     "sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==";
linkElement.crossOrigin = "anonymous";
linkElement.referrerPolicy = "no-referrer";

document.head.appendChild(linkElement);
