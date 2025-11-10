# Portfolio & Blog System

A dystopian terminal-themed portfolio with a file-based blog system built with Laravel and Tailwind CSS.

## Features

- 🖥️ **Terminal/SpaceX-Inspired Theme**: Dystopian black & white design with green terminal aesthetics
- 📝 **File-Based Blog System**: Write blogs in Markdown with front matter
- 🎨 **Advanced Animations**: Glitch effects, typing animations, parallax scrolling, CRT scan lines
- 📱 **Fully Responsive**: Works beautifully on all devices
- ⚡ **Performance Optimized**: Built with Vite and Tailwind CSS
- 🎯 **SEO Friendly**: Proper meta tags and semantic HTML

## Portfolio Sections

1. **Hero Section**: Eye-catching introduction with typing effect
2. **About**: Personal information and links
3. **Experience**: Timeline of professional experience
4. **Skills**: Technical skills with progress bars
5. **Projects**: Showcase of your best work
6. **Contact**: Get in touch section
7. **Blog**: Your technical writing and thoughts

## How to Add a New Blog Post

### 1. Create a Blog Folder

Create a new folder in `storage/app/blogs/` with a slug for your blog:

```bash
mkdir -p storage/app/blogs/my-awesome-blog
mkdir -p storage/app/blogs/my-awesome-blog/images
mkdir -p storage/app/blogs/my-awesome-blog/downloads
```

### 2. Create the Markdown File

Create `content.md` in your blog folder:

```markdown
---
title: "My Awesome Blog Post"
date: "2024-11-10"
excerpt: "A short description of your blog post that appears in the blog listing."
tags: ["Laravel", "PHP", "Web Development"]
featured_image: "images/hero.jpg"
---

# Your Blog Title

Your blog content goes here in **Markdown** format!

## Subheadings

- Bullet points
- Are supported

### Code Blocks

\`\`\`php
<?php
echo "Hello, World!";
\`\`\`

### Images

![Alt text](images/my-image.png)

### Downloads

You can reference downloadable files that you place in the downloads folder.
```

### 3. Add Images

Place your images in `storage/app/blogs/my-awesome-blog/images/`:

```bash
cp /path/to/your/image.jpg storage/app/blogs/my-awesome-blog/images/
```

### 4. Add Downloadable Resources

Place any downloadable files in `storage/app/blogs/my-awesome-blog/downloads/`:

```bash
cp /path/to/your/file.pdf storage/app/blogs/my-awesome-blog/downloads/
```

## Customizing Your Portfolio

### Update Personal Information

Edit `resources/views/portfolio.blade.php` and update:

1. **Hero Section**: Your name and title
2. **About Section**: Your bio and links
3. **Experience**: Add/edit your work experience
4. **Skills**: Update your technical skills
5. **Projects**: Showcase your projects
6. **Contact**: Update contact information

### Change Theme Colors

Edit `resources/css/app.css` to customize colors:

```css
@theme {
    --color-terminal-green: #00ff41;  /* Change terminal green */
    --color-terminal-bg: #0a0a0a;     /* Background color */
}
```

### Modify Navigation

Edit `resources/views/partials/navigation.blade.php` to add/remove menu items.

### Update Footer

Edit `resources/views/partials/footer.blade.php` to change footer content.

## Terminal Effects

The portfolio includes several terminal effects:

- **Scan Line**: CRT monitor scan line effect
- **Matrix Rain**: Optional matrix rain background
- **Typing Effect**: Terminal-style typing animation
- **Glitch Effect**: Hover glitch effect on elements
- **Terminal Glow**: Green glow effect on borders and text

## Development

### Running the Development Server

```bash
php artisan serve
npm run dev
```

Visit: http://127.0.0.1:8000

### Building for Production

```bash
npm run build
```

## Blog Features

### Front Matter Fields

- `title`: Blog post title (required)
- `date`: Publication date in YYYY-MM-DD format (required)
- `excerpt`: Short description for blog listing
- `tags`: Array of tags
- `featured_image`: Path to featured image (relative to blog folder)

### Markdown Support

The blog system supports:

- Headings (H1-H6)
- Bold, italic text
- Links
- Images
- Code blocks with syntax highlighting
- Lists (ordered and unordered)
- Blockquotes
- Tables
- Horizontal rules

### Image References

In your markdown, reference images like:

```markdown
![Description](images/my-image.jpg)
```

The system will automatically serve them from your blog's images folder.

## Social Links

Update your social media links in:

- `resources/views/partials/footer.blade.php`
- `resources/views/portfolio.blade.php` (About section)

Replace the placeholder URLs with your actual profiles:

- GitHub
- LinkedIn
- Twitter/X
- Email

## Animations

### Typing Effect

Add `data-type` attribute to any element:

```html
<span data-type="Your text here" data-speed="100"></span>
```

### Fade In Sections

Add class `fade-in-section` to elements you want to fade in on scroll:

```html
<div class="fade-in-section">
    <!-- Your content -->
</div>
```

### Parallax Effect

Add `data-parallax` attribute for parallax scrolling:

```html
<div data-parallax="0.5">
    <!-- Your content -->
</div>
```

## Tips

1. **LinkedIn Profile**: Update the LinkedIn URL in navigation and footer
2. **GitHub Projects**: Link your actual GitHub repositories in the projects section
3. **Resume**: Add a link to your resume PDF in the about section
4. **Blog Images**: Use optimized images (WebP format recommended)
5. **Meta Tags**: Add proper meta tags for better SEO
6. **Analytics**: Add Google Analytics or similar in the layout file

## Deployment

The portfolio includes deployment scripts. Check:

- `deploy.sh` - Main deployment script
- `deploy-fast.sh` - Quick deployment
- `DEPLOYMENT.md` - Deployment instructions

## Browser Support

- Chrome/Edge (latest)
- Firefox (latest)
- Safari (latest)
- Mobile browsers

## Credits

Built with:

- Laravel 12
- Tailwind CSS 4
- Vite
- CommonMark (Markdown parser)

## License

This portfolio is for personal use. Feel free to customize it to your needs!

---

**Happy Coding!** 🚀

For questions or issues, reach out via the contact form or check the documentation.
