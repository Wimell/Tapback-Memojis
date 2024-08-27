![Tapback Memoji H1](./public/images/og-image.png)

# Tapback Memoji's

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Version](https://img.shields.io/badge/version-1.0.0-brightgreen.svg)
![API Status](https://img.shields.io/badge/API-active-success.svg)
[![GitHub stars](https://img.shields.io/github/stars/wimell/Tapback-Memojis.svg)](https://github.com/wimell/Tapback-Memojis/stargazers)

Open source memojis for your apps, designs, and websites. Created by [@wes_wim](https://github.com/wes_wim)

## 🚀 Overview

Tapback Memoji API provides a simple and efficient way to generate unique avatar images for your applications. Whether you need consistent avatars for user profiles or random avatars for placeholder content, our API has got you covered.

## 🔗 Usage

### Get a specific avatar:

<img src="https://www.tapback.co/api/avatar/user57.webp?color=4" alt="Tapback Memoji Example" width="64">
<img src="https://www.tapback.co/api/avatar/user57.webp?color=4" alt="Tapback Memoji Example" width="64">

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
