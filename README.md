![Tapback Memoji H1](./assets/og-image.png)

# Tapback Memoji's

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Version](https://img.shields.io/badge/version-1.0.0-brightgreen.svg)
![API Status](https://img.shields.io/badge/API-active-success.svg)
[![GitHub stars](https://img.shields.io/github/stars/wimell/Tapback-Memojis.svg)](https://github.com/wimell/Tapback-Memojis/stargazers)


## 🚀 Overview

Tapback Memoji API provides a simple and efficient way to generate unique Apple Memoji style avatars for your applications. Create a random avatar, or generate one based on any string.

Check out the [website](https://www.tapback.co?ref=github-readme) for more information on the API, or install the Laravel app locally via the `src` directory.

Key use cases:
- Dynamic user avatars
- Placeholder avatars
- Figma prototyping


<div style="display: flex; align-items: center; gap: 10px;">
  <img src="https://www.tapback.co/api/avatar/user57.webp?color=4" alt="Tapback Memoji Example" width="64">
  <img src="https://www.tapback.co/api/avatar/user10.webp?color=7" alt="Tapback Memoji Example" width="64">
  <img src="https://www.tapback.co/api/avatar/user16.webp?color=12" alt="Tapback Memoji Example" width="64">
  <img src="https://www.tapback.co/api/avatar/user22.webp?color=10" alt="Tapback Memoji Example" width="64">
</div>

## 🔗 Usage

### Get a specific avatar:



```
https://www.tapback.co/api/avatar/{name}.webp
```
Replace `{name}` with any string to generate a unique avatar.

### Get a random avatar:
```
https://www.tapback.co/api/avatar.webp
```

## 🖼️ Example Implementation

HTML:
```html
<img src="https://www.tapback.co/api/avatar/johndoe" alt="User Avatar">
```

## ✨ Features

- Unique avatars generated based on input string
- Consistent generation for the same input
- No authentication required
- Fast response times
- Suitable for various applications
