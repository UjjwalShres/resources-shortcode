# Resources Shortcode Plugin
This plugin registers a **Custom Post Type** named **"Resources"** and provides a **shortcode** to display the latest resources in a clean, responsive grid layout.

## Features
- Registers a **"Resources"** Custom Post Type  
- Displays latest resources using a **shortcode**  
- Fully **responsive grid layout**  
- Displays:
  - Title  
  - Featured Image  
  - Short Description (Excerpt)  
  - “Read More” link  
- Built following **WordPress coding standards & best practices**  
- Uses **proper hooks**, **enqueue functions**, and **output sanitization**

## Installation
1. Download or clone this repository.  
2. Upload the `resources-shortcode` folder to your `/wp-content/plugins/` directory.  
3. Activate the plugin from your **WordPress Admin → Plugins** page.  
4. Create a few posts under **Resources** in your dashboard.

## Usage
Add the following shortcode to any page, post, or widget:

### Shortcode Attributes
| Attribute | Description | Default |
|------------|--------------|----------|
| `limit` | Number of resources to display | `5` |

Example:
[latest_resources limit="3"]

## Output Example
Each resource item displays:
- **Featured Image**
- **Title** (linked to full post)
- **Excerpt / Short Description**
- **Read More** link

The layout adapts automatically to screen sizes (mobile, tablet, desktop).

## Code Overview

### 1. Custom Post Type
Defined using the `register_post_type()` function with support for:
- `title`
- `editor`
- `thumbnail`
- `excerpt`

### 2. Shortcode
Defined via `add_shortcode()`:
- Queries latest resources
- Sanitizes and escapes all output
- Wraps results in a responsive grid

## Security
- All output is escaped using esc_html() and similar functions.
- Prevents direct access using if ( ! defined( 'ABSPATH' ) ) exit;.

## Author Notes
This plugin was developed as part of a WordPress Developer assessment task to demonstrate:
- Familiarity with CPTs, shortcodes, and WordPress hooks
- Clean, modular, and maintainable code structure
- Adherence to WordPress coding standards
