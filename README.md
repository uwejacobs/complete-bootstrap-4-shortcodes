# Complete Bootstrap 4 Shortcodes

![WordPress
Rating](https://img.shields.io/wordpress/plugin/r/complete-bootstrap-4-shortcodes.svg)
![WordPress
Downloads](https://img.shields.io/wordpress/plugin/dt/complete-bootstrap-4-shortcodes.svg)

WordPress plugin that provides shortcodes for easier use of the
Bootstrap styles and components in your content.

**Bootstrap 4 Shortcodes for WordPress** creates a simple, out of the
way button just above the WordPress TinyMCE editor (next to the "Add
Media" button) which pops up the plugin's documentation and shortcode
examples for reference and handy "Insert Example" links to send the
example shortcodes straight to the editor. There are no additional
TinyMCE buttons to clutter up your screen, just great, easy to use
shortcodes\!

## Requirements

![Tested in
WordPress](https://img.shields.io/wordpress/v/complete-bootstrap-4-shortcodes.svg)
![PHP 7.0+](https://img.shields.io/badge/PHP-7.0%2B-blue.svg)
![Bootstrap](https://img.shields.io/badge/Bootstrap-4.6.x-6f5499.svg)

This plugin won't do anything if you don't have WordPress theme built
with the [Bootstrap](https://getbootstrap.com/) framework. **This plugin
does not include the Bootstrap framework**. The icon shortcodes require
Font Awesome 5 or better.

The plugin is tested to work with `Bootstrap 4.6` and `WordPress 5.8`
and **requires PHP 7.0 or better**.

Wordpress is not able to process nested shortcodes - like a `card`
inside a `card` - correctly; see [Wordpress: Nested
Shortcodes](https://codex.wordpress.org/Shortcode_API#Nested_Shortcodes).
Some of the shortcodes have aliases with the extension `-outer` to allow
nesting.

## Shortcode Reference

![](https://www.paypal.com/en_US/i/scr/pixel.gif) Thanks for your
consideration\!

[](#layout)

### Layout

  - [Grid](#grid)
  - [Responsive Embeds](#responsive-embeds)
  - [Responsive Utilities](#responsive-utilities)

[](#components)

### Components

  - [Cards](#cards)
  - [Icons](#icons)
  - [Buttons](#buttons)
  - [Button Groups](#button-groups)
  - [Button Dropdowns](#button-dropdowns)
  - [Navs](#navs)
  - [Navigation Bars](#navigation-bars)
  - [Breadcrumbs](#breadcrumbs)
  - [Badges](#badges)
  - [Jumbotron](#jumbotron)
  - [Alerts](#alerts)
  - [Progress Bars](#progress-bars)
  - [Media Objects](#media-objects)
  - [List Groups](#list-groups)

[](#content)

### Content

  - [Code](#code)
  - [Tables](#tables)
  - [Figures](#figures)
  - [Images](#images)
  - [Blockquote](#blockquote)
  - [Lead body copy](#lead-body-copy)
  - [Wrap section](#wrap-section)

[](#utilities)

### Utilities

  - [Border](#border)
  - [Color](#color)
  - [Flex](#flex)
  - [HTML snippets](#html-snippets)
  - [Line Breaks](#line-breaks)
  - [Lorem Ipsum Text Generator](#lorem-ipsum-text-generator)
  - [Floats and Clearfix](#floats-and-clearfix)

[](#javascript)

### Javascript

  - [Tooltip](#tooltip)
  - [Popover](#popover)
  - [Collapse](#collapse)
  - [Carousel](#carousel)
  - [Modal](#modal)

# Usage

### Layout

### Grid

The tags `[row-outer]` and `[column-outer]` allow nesting of rows and
columns.

    [row]
        [column md="6"]
            [lorem-ipsum]
        [/column]
        [column md="6"]
            [lorem-ipsum]
        [/column]
    [/row]

Nested rows and columns.

    [row-outer]
        [column-outer xs="3" class="bg-info"]
            [row]
                [column xs="6"]Col 1.1[/column]
                [column xs="6"]Col 1.2[/column]
            [/row]
        [/column-outer]
        [column-outer xs="6" class="bg-success"]
            [row]
                [column xs="6"]Col 2.1[/column]
                [column xs="6"]Col 2.2[/column]
            [/row]
        [/column-outer]
        [column-outer xs="3" class="bg-danger"]
            [row]
                [column xs="6"]Col 3.1[/column]
                [column xs="6"]Col 3.2[/column]
            [/row]
        [/column-outer]
    [/row-outer]

The container component is also supported in case your theme doesn't
include a container.

    [container]
        [row]
            [column md="6"]
                [lorem-ipsum]
            [/column]
            [column md="6"]
                [lorem-ipsum]
            [/column]
        [/row]
    [/container]

The container-fluid component is supported as a discrete shortcode for
cases where you want to wrap a container.

    [container-fluid]
        [container]
            [row]
                [column md="6"]
                    [lorem-ipsum]
                [/column]
                [column md="6"]
                    [lorem-ipsum]
                [/column]
            [/row]
        [/container]
    [/container-fluid]

#### \[container\] parameters

| Parameter | Description                                                                                                                                                                                                         | Required | Values                 | Default |
| --------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| fluid     | Create a full width container, spanning the entire width of the viewport. (see [Bootstrap documentation](https://getbootstrap.com/docs/4.6/layout/overview/#fluid) for details). This overrides the size parameter. | optional | 🚩 (flag)               |         |
| size      | Use the container size to create responsive containers where the max-width of the container will change on different screen sizes/viewports.                                                                        | optional | sm, md, lg or xl       |         |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                                                                                      | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                                                                                                   | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. Example: `data="columns,3\|index,1"` expands to `data-columns="3" data-index="1"`.                                                    | optional | any text               | none    |

#### \[container-fluid\] parameters

| Parameter | Description                                                                                                                                      | Required | Values                 | Default |
| --------- | ------------------------------------------------------------------------------------------------------------------------------------------------ | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                   | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                                | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters)). | optional | any text               | none    |

#### \[row\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[column\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| xs        | Size of column on extra small screens (less than 576px)                                                                                         | optional | 1-12                   | false   |
| sm        | Size of column on small screens (greater than 576px)                                                                                            | optional | 1-12                   | false   |
| md        | Size of column on medium screens (greater than 768px)                                                                                           | optional | 1-12                   | false   |
| lg        | Size of column on large screens (greater than 992px)                                                                                            | optional | 1-12                   | false   |
| xl        | Size of column on extra large screens (greater than 1200px)                                                                                     | optional | 1-12                   | false   |
| offset-xs | Offset on extra small screens                                                                                                                   | optional | 1-12                   | false   |
| offset-sm | Offset on small screens                                                                                                                         | optional | 1-12                   | false   |
| offset-md | Offset on column on medium screens                                                                                                              | optional | 1-12                   | false   |
| offset-lg | Offset on column on large screens                                                                                                               | optional | 1-12                   | false   |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap grid
documentation](https://getbootstrap.com/docs/4.6/layout/grid/).

-----

### Responsive Embeds

    [embed-responsive ratio="16by9"] [/embed-responsive]

Wrap `<iframe>`, `<embed>`, `<video>`, and `<object>` elements to make
them
responsive.

#### \[responsive-embed\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                   | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ------------------------ | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier   |         |
| ratio     | Maintain the aspect ratio of the embed                                                                                                          | optional | 1by1, 4by3, 16by9, 21by9 | false   |
| class     | Any extra classes you want to add                                                                                                               | optional | any text                 | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text                 | none    |

[Bootstrap responsive embed
documentation](https://getbootstrap.com/docs/4.6/utilities/embed/)

-----

### Responsive Utilities

    [responsive block="xl lg md" hidden="sm xs"] [lorem-ipsum] [/responsive]

#### \[reponsive\] parameters

| Parameter     | Description                                                                                                                                     | Required | Values                 | Default |
| ------------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id            | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| hidden        | Sizes at which this element is hidden (separated by spaces)                                                                                     | optional | xs, sm, md, lg, xl     | false   |
| block         | Sizes at which this element is visible and displayed as a "block" element (separated by spaces)                                                 | optional | xs, sm, md, lg, xl     | false   |
| inline        | Sizes at which this element is visible and displayed as an "inline" element (separated by spaces)                                               | optional | xs, sm, md, lg, xl     | false   |
| inline\_block | Sizes at which this element is visible and displayed as an "inline-block" element (separated by spaces)                                         | optional | xs, sm, md, lg, xl     | false   |
| class         | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data          | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap display properties
documentation](https://getbootstrap.com/docs/4.6/utilities/display/#hiding-elements)

-----

### Components

### Cards

    [card]
      [list-group]
        [list-group-item]Cras justo odio[/list-group-item]
        [list-group-item]Dapibus ac facilisis in[/list-group-item]
        [list-group-item]Vestibulum at eros[/list-group-item]
      [/list-group]
    [/card]

##### Kitchen sink

    [card]
      [card-img top]
        [img-gen bg="f00" text=" " class="img-fluid"]
      [/card-img]
      [card-body]
        [card-title]
          Card Title
        [/card-title]
          Some quick example text to build on the card title and make up the bulk of the card's content.
      [/card-body]
      [list-group flush]
        [list-group-item]Cras justo odio[/list-group-item]
        [list-group-item]Dapibus ac facilisis in[/list-group-item]
        [list-group-item]Vestibulum at eros[/list-group-item]
      [/list-group]
      [card-body]
        <a href="#">Lorem Ipsup</a> <a href="#">Dolor Sit</a>
      [/card-body]
    [/card]

##### Card with image cap

Image caps are supported with the `[card-img]` shortcode and the `top`
or `bottom` flag.

    [card]
      [card-img top]
        [img-gen bg="f00"  text=" " class="img-fluid"]
      [/card-img]
      [card-body]
        [card-title]
          Card Title
        [/card-title]
        Lorem ipsum dolor sit.
      [/card-body]
    [/card]

##### Card with image overlay

Image overlay cards are supported with the `[card-img-overlay]`
shortcode.

    [card]
      [card-img]
        [img-gen bg="f00" text=" " class="img-fluid"]
      [/card-img]
      [card-img-overlay]
        [card-title]
          Card Title
        [/card-title]
        Lorem ipsum dolor sit.
      [/card-img-overlay]
    [/card]

##### Card with Header and Footer

Card header and card footers are supported with the `[card-header]` and
`[card-footer]` shortcodes.

    [card]
      [card-header]
        Example Header
      [/card-header]
      [card-body]
        [card-title]
          Card Title
        [/card-title]
        Lorem ipsum dolor sit.
      [/card-body]
      [card-footer]
        Example footer.
      [/card-footer]
    [/card]

##### Card group

Use card groups to render cards as a single, attached element with equal
width and height columns.

    [card-group]
      [card]
        [card-body]
          [card-title]
            Card Title
          [/card-title]
          Lorem ipsum dolor sit.
        [/card-body]
      [/card]
      [card]
        [card-body]
          [card-title]
            Card Title
          [/card-title]
          Cras justo odio.
        [/card-body]
      [/card]
      [card]
        [card-body]
          [card-title]
            Card Title
          [/card-title]
          Dapibus ac facilisis in.
        [/card-body]
      [/card]
    [/card-group]

##### Card deck

Use a card deck for a set of equal width and height cards that aren’t
attached to one another.

    [card-deck]
      [card]
        [card-body]
          [card-title]
            Card Title
          [/card-title]
          Lorem ipsum dolor sit.
        [/card-body]
      [/card]
      [card]
        [card-body]
          [card-title]
            Card Title
          [/card-title]
          Cras justo odio.
        [/card-body]
      [/card]
      [card]
        [card-body]
          [card-title]
            Card Title
          [/card-title]
          Dapibus ac facilisis in.
        [/card-body]
      [/card]
    [/card-deck]

##### Card columns

Cards can be organized into Masonry-like columns with just CSS by
wrapping them in `[card-columns]`

    [card-columns]
      [card]
        [card-body]
          [card-title]
            Card Title
          [/card-title]
          Lorem ipsum dolor sit.
        [/card-body]
      [/card]
      [card]
        [card-body]
          [card-title]
            Card Title
          [/card-title]
          Cras justo odio.
        [/card-body]
      [/card]
      [card]
        [card-body]
          [card-title]
            Card Title
          [/card-title]
          Dapibus ac facilisis in.
        [/card-body]
      [/card]
    [/card-columns]

#### \[card\] parameters

The tag `[card-outer]` allows to nest cards inside a
card.

| Parameter | Description                                                                   | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                | optional | Unique text identifier |         |
| show      | Show the collapsible card content by default.                                 | optional | 🚩 (flag)               |         |
| class     | Any extra classes you want to add.                                            | optional | any text               |         |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. | optional | any text               |         |

#### \[card-body\] parameters

<div class="alert alert-warning">

**Note:** Any `p`, `a` or `blockquote` tags within `[card-body]` will
automatically receive `card-text`, `card-link` or `card-bodyquote`
classes respectively.

</div>

The tag `[card-body-outer]` allows to nest cards inside a card
body.

| Parameter | Description                                                                   | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                | optional | Unique text identifier |         |
| class     | Any extra classes you want to add.                                            | optional | any text               |         |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. | optional | any text               |         |

#### \[card-title\] parameters

<div class="alert alert-warning">

**Note:** `[card-title]` should contain a heading tag (`h1`, `h2`, `h3`,
`h4`, `h5`, or `h6`), inserted using the WordPress editor. If a heading
tag is not added `h4` will be inserted
automatically.

</div>

| Parameter | Description                                                                   | Required | Values   | Default |
| --------- | ----------------------------------------------------------------------------- | -------- | -------- | ------- |
| class     | Any extra classes you want to add.                                            | optional | any text |         |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. | optional | any text |         |

#### \[card-subtitle\] parameters

<div class="alert alert-warning">

**Note:** `[card-subtitle]` should contain a heading tag (`h1`, `h2`,
`h3`, `h4`, `h5`, or `h6`), inserted using the WordPress editor. If a
heading tag is not added `h6` will be inserted
automatically.

</div>

| Parameter | Description                                                                   | Required | Values   | Default |
| --------- | ----------------------------------------------------------------------------- | -------- | -------- | ------- |
| class     | Any extra classes you want to add.                                            | optional | any text |         |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. | optional | any text |         |

#### \[card-img\] parameters

<div class="alert alert-warning">

**Note:** `[card-img]` should contain an image inserted using the
WordPress editor or the `img-gen`
tag.

</div>

| Parameter | Description                                                                   | Required | Values   | Default |
| --------- | ----------------------------------------------------------------------------- | -------- | -------- | ------- |
| top       | Flag whether this image cap is at the top of the card.                        | optional | 🚩 (flag) |         |
| bottom    | Flag whether this image cap is at the bottom of the card.                     | optional | 🚩 (flag) |         |
| class     | Any extra classes you want to add.                                            | optional | any text |         |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. | optional | any text |         |

#### \[card-img-overlay\] parameters

| Parameter | Description                                                                   | Required | Values   | Default |
| --------- | ----------------------------------------------------------------------------- | -------- | -------- | ------- |
| class     | Any extra classes you want to add.                                            | optional | any text |         |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. | optional | any text |         |

#### \[card-header\] parameters

<div class="alert alert-warning">

**Note:** `[card-header]` should contain a heading tag (`h1`, `h2`,
`h3`, `h4`, `h5`, or `h6`), inserted using the WordPress editor. If a
heading tag is not added `div` (no heading) will be inserted
automatically.

</div>

| Parameter | Description                                                                   | Required | Values   | Default |
| --------- | ----------------------------------------------------------------------------- | -------- | -------- | ------- |
| class     | Any extra classes you want to add.                                            | optional | any text |         |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. | optional | any text |         |

#### \[card-footer\] parameters

| Parameter | Description                                                                   | Required | Values   | Default |
| --------- | ----------------------------------------------------------------------------- | -------- | -------- | ------- |
| class     | Any extra classes you want to add.                                            | optional | any text |         |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. | optional | any text |         |

#### \[card-group\] parameters

| Parameter | Description                                                                   | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                | optional | Unique text identifier |         |
| class     | Any extra classes you want to add.                                            | optional | any text               |         |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. | optional | any text               |         |

#### \[card-deck\] parameters

| Parameter | Description                                                                   | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                | optional | Unique text identifier |         |
| class     | Any extra classes you want to add.                                            | optional | any text               |         |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. | optional | any text               |         |

#### \[card-columns\] parameters

id

Name the container for processing in custom CSS or JavaScript.

optional

Unique text identifier

Parameter

Description

Required

Values

Default

class

Any extra classes you want to add.

optional

any text

data

Data attribute and value pairs separated by a comma. Pairs separated by
pipe.

optional

any text

[Bootstrap card
documentation](https://getbootstrap.com/docs/4.6/components/card/)

-----

### Icons

<div class="alert alert-warning">

**Note:** The `[icon]` and `[icon-stack]` shortcodes depend on the Font
Awesome 5 Icon Library, either from your theme or the official Font
Awesome plugin.

</div>

    [icon name="arrow-right"]

#### \[icon\] parameters

<table>
<thead>
<tr class="header">
<th>Parameter</th>
<th>Description</th>
<th>Required</th>
<th>Values</th>
<th>Default</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td>prefix</td>
<td>The icon set of the icon you want to display</td>
<td>optional</td>
<td>fab, fas (free)<br />
fad, fal, far (pro)</td>
<td>fas</td>
</tr>
<tr class="even">
<td>id</td>
<td>Name the container for processing in custom CSS or JavaScript.</td>
<td>optional</td>
<td>Unique text identifier</td>
<td></td>
</tr>
<tr class="odd">
<td>name</td>
<td>The name of icon you want to display</td>
<td>required</td>
<td>See <a href="https://fontawesome.com/icons?d=gallery&amp;m=free">Font Awesome Searchable Gallery</a></td>
<td>none</td>
</tr>
<tr class="even">
<td>class</td>
<td>Any extra classes you want to add</td>
<td>optional</td>
<td>any text</td>
<td>none</td>
</tr>
<tr class="odd">
<td>data</td>
<td>Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at <a href="#container-parameters">[container] parameters</a>.</td>
<td>optional</td>
<td>any text</td>
<td>none</td>
</tr>
</tbody>
</table>

[Font Awesome
Documentation](https://fontawesome.com/how-to-use/on-the-web/referencing-icons/basic-use)

-----

### Icon Stacks

Print multiple icons on top of each other.

    [icon-stack]
        [icon name="camera" class="fa-stack-1x"]
        [icon name="ban" class="fa-stack-2x text-danger"]
    [/icon-stack]

#### \[icon-stack\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Font Awesome
Documentation](https://fontawesome.com/how-to-use/on-the-web/referencing-icons/basic-use)

-----

### Buttons

    [button type="success" size="lg"] Action [/button]

#### \[button\] parameters

| Parameter  | Description                                                                                                                                     | Required | Values                                                                | Default           |
| ---------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | --------------------------------------------------------------------- | ----------------- |
| id         | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier                                                | bs4-button-\#\#\# |
| type       | The type of the button                                                                                                                          | optional | primary, secondary, success, info, warning, danger, dark, light, link | primary           |
| size       | The size of the button                                                                                                                          | optional | sm, md, lg                                                            | md                |
| block      | Whether the button should be a block-level button                                                                                               | optional | 🚩 (flag)                                                              |                   |
| dropdown   | Whether the button triggers a dropdown menu (see [Button Dropdowns](#button-dropdowns))                                                         | optional | 🚩 (flag)                                                              |                   |
| modal      | Whether the button triggers a modal popup (see [Modal](#modal))                                                                                 | optional | The id of the modal                                                   |                   |
| active     | Apply the "active" style                                                                                                                        | optional | 🚩 (flag)                                                              |                   |
| disabled   | Whether the button will be disabled                                                                                                             | optional | 🚩 (flag)                                                              |                   |
| split      | Create a split button dropdown next to another button or link                                                                                   | optional | 🚩 (flag)                                                              |                   |
| outline    | Turn the button into a bordered/outlined button                                                                                                 | optional | 🚩 (flag)                                                              |                   |
| tag        | The html tag of the button                                                                                                                      | optional | `button` or `a`                                                       | button            |
| link       | The url you want the tag `a` to link to                                                                                                         | optional | any valid link                                                        | \#                |
| target     | Where to open the link for tag `a`                                                                                                              | optional | \_self, \_blank, \_parent, \_top                                      | \_self            |
| aria-label | If there is no text inside the button then an aria-label attribute can be used to give the button an accessible name                            | optional | Any text                                                              |                   |
| class      | Any extra classes you want to add                                                                                                               | optional | any text                                                              | none              |
| data       | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text                                                              | none              |

[Bootstrap button
documentation](https://getbootstrap.com/docs/4.6/components/buttons/)

-----

### Button Groups

The tag `[button-group-outer]` allows nesting of button groups.

#### Basic example

    [button-group size="lg" justified]
        [button] Left [/button]
        [button] Middle [/button]
        [button] Right [/button]
    [/button-group]

#### Button toolbar

    [button-toolbar]
        [button-group class="mr-2"]
            [button] Left 1 [/button]
            [button] Middle 1 [/button]
            [button] Right 1 [/button]
        [/button-group]
        [button-group class="mr-2"]
            [button] Left 2 [/button]
            [button] Middle 2 [/button]
            [button] Right 2 [/button]
        [/button-group]
        [button-group]
            [button] Single [/button]
        [/button-group]
    [/button-toolbar]

#### \[button-group\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| size      | The size of the button group                                                                                                                    | optional | sm, md, lg             | md      |
| justified | Whether button group is justified                                                                                                               | optional | 🚩 (flag)               |         |
| vertical  | Whether button group is vertical                                                                                                                | optional | 🚩 (flag)               |         |
| drop      | **Must correspond with the use of \[dropdown\]**                                                                                                | optional | up, left, right        | (down)  |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[button-toolbar\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap button groups
documentation](https://getbootstrap.com/docs/4.6/components/button-group/)

-----

### Button Dropdowns

Button Dropdowns can be accomplished by combining the \[button-group\]
shortcode, the "data" parameters of the \[button\] shortcode, and
\[dropdown\] or \[dropdown-menu\] shortcode as follows.

#### Single button dropdowns

    [dropdown]
        [button type="warning" dropdown] Action[/button]
        [dropdown-menu]
            [dropdown-header] Header[/dropdown-header]
            [dropdown-item link="#"]Action[/dropdown-item]
            [dropdown-item link="#"]Another action[/dropdown-item]
            [dropdown-item link="#"]Something else here[/dropdown-item]
            [dropdown-divider]
            [dropdown-item link="#"]Separated link[/dropdown-item]
        [/dropdown-menu]
    [/dropdown]

#### Split button dropdowns

    [button-group]
        [button type="danger"] Split Action[/button]
        [button type="danger" dropdown split][/button]
            [dropdown-menu]
                [dropdown-item link="#"]Action[/dropdown-item]
                [dropdown-item link="#"]Another action[/dropdown-item]
                [dropdown-item link="#"]Something else here[/dropdown-item]
                [dropdown-divider]
                [dropdown-item link="#"]Separated link[/dropdown-item]
            [/dropdown-menu]
    [/button-group]

#### Drop variation

    [button-group drop="up"]
        [button] Drop Up [/button]
        [button dropdown][/button]
        [dropdown-menu]
            [dropdown-item link="#"] Action 1 [/dropdown-item]
            [dropdown-item link="#"] Action 2 [/dropdown-item]
            [dropdown-divider]
            [dropdown-item link="#"] Separated Action [/dropdown-item]
        [/dropdown-menu]
    [/button-group]

#### \[dropdown\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[dropdown-menu\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| right     | To right-align the menu with the button or link                                                                                                 | optional | 🚩 (flag)               | (left)  |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

-----

#### \[dropdown-item\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| link      | The url you want the dropdown-item to link to                                                                                                   | optional | any valid link         | \#      |
| disabled  | Whether this menu-item is disabled                                                                                                              | optional | 🚩 (flag)               |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[dropdown-header\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[dropdown-divider\] parameters

| Parameter | Description                                                                                                                                     | Required | Values   | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | -------- | ------- |
| class     | Any extra classes you want to add                                                                                                               | optional | any text | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text | none    |

[Bootstrap button dropdowns
documentation](https://getbootstrap.com/docs/4.6/components/dropdowns/)

-----

### Navs

    [nav tabs]
        [nav-item link="#"] Link1 [/nav-item]
        [nav-item link="#"] Link2 [/nav-item]
        [nav-item link="#"] Link3 [/nav-item]
    [/nav]

#### Nav with active, disabled and dropdowns

    [nav tabs]
        [nav-item link="#" active] Active [/nav-item]
        [nav-item link="#" disabled] Disabled [/nav-item]
        [nav-item dropdown link="#"] Drop [dropdown-menu]
                [dropdown-item link="#"] Link1 [/dropdown-item]
                [dropdown-item link="#"] Link2 [/dropdown-item]
            [/dropdown-menu]
        [/nav-item]
    [/nav]

#### \[nav\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| tabs      | Generate a tabbed interface                                                                                                                     | optional | 🚩 (flag)               |         |
| pills     | Generate a interface with pills                                                                                                                 | optional | 🚩 (flag)               |         |
| stacked   | Whether the nav is stacked (should be used with "pills" type                                                                                    | optional | 🚩 (flag)               |         |
| justified | Whether the nav is justified                                                                                                                    | optional | 🚩 (flag)               |         |
| fill      | Proportionately fill all available space                                                                                                        | optional | 🚩 (flag)               |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[nav-item\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| link      | The url you want the dropdown-item to link to                                                                                                   | optional | any text               | \#      |
| dropdown  | Whether the item activates a "dropdown" menu                                                                                                    | optional | 🚩 (flag)               |         |
| active    | Whether the item has the "active" style applied                                                                                                 | optional | 🚩 (flag)               |         |
| disabled  | Whether the item is disabled                                                                                                                    | optional | 🚩 (flag)               |         |
| listclass | Any extra classes you want to add to the list                                                                                                   | optional | any text               | none    |
| class     | Any extra classes you want to add to the link                                                                                                   | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap button navs
documentation](https://getbootstrap.com/docs/4.6/components/navs/)

-----

### Navigation Bars

#### Collapsible Navigation Bar

    [navbar expand="md" class="navbar-light bg-light"]
      [navbar-brand link="#"][img-gen type="circle" responsive size="150x50" text="Brand"][/navbar-brand]
      [navbar-toggler]
      [navbar-content]
        [nav bar class="ml-auto"]
          [nav-item link="#" active]Home[/nav-item]
          [nav-item link="#"]Link[/nav-item]
          [nav-item link="#"]Another Link[/nav-item]
          [nav-item dropdown link="#"]Dropdown
            [dropdown-menu]
              [dropdown-header]Header[/dropdown-header]
              [dropdown-item link="#"]Action[/dropdown-item]
              [dropdown-item link="#"]Another action[/dropdown-item]
              [dropdown-item link="#"]Something else here[/dropdown-item]
              [dropdown-divider]
              [dropdown-item link="#"]Separated link[/dropdown-item]
            [/dropdown-menu]
          [/nav-item]
          [nav-item link="#" disabled]Disabled[/nav-item]
        [/nav]
      [/navbar-content]
    [/navbar]

Use the classes `ml_auto`, `mx_auto` and `mr_auto` to position the
labels to the right, centered, or to the left; left is the default. The
`[navbar]` shortcode must include the class `navbar_dark` or
`navbar_light`, depending on the background color of the navigation bar,
or the labels and the hamburger will not have a color assigned.

#### Vertical Navigation Bar

    [navbar class="navbar-light bg-light"]
        [nav bar class="mr-auto"]
          [nav-item link="#" active]Home[/nav-item]
          [nav-item link="#"]Link[/nav-item]
          [nav-item link="#"]Another Link[/nav-item]
          [nav-item dropdown link="#"]Dropdown
            [dropdown-menu]
              [dropdown-header]Header[/dropdown-header]
              [dropdown-item link="#"]Action[/dropdown-item]
              [dropdown-item link="#"]Another action[/dropdown-item]
              [dropdown-item link="#"]Something else here[/dropdown-item]
              [dropdown-divider]
              [dropdown-item link="#"]Separated link[/dropdown-item]
            [/dropdown-menu]
          [/nav-item]
          [nav-item link="#" disabled]Disabled[/nav-item]
        [/nav]
    [/navbar]

#### \[navbar\] parameters

| Parameter | Description                                                                                                                                            | Required | Values                 | Default |
| --------- | ------------------------------------------------------------------------------------------------------------------------------------------------------ | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                         | optional | Unique text identifier |         |
| expand    | Navbars utilize `[navbar-toggler]`, `[navbar-collapse]`, and `expand={sm\|md\|lg\|xl}` classes to change when their content collapses behind a button. | optional | sm, md, lg, xl         | none    |
| class     | Any extra classes you want to add                                                                                                                      | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters).        | optional | any text               | none    |

[Bootstrap Navbar
documentation](https://getbootstrap.com/docs/4.0/components/navbar/)

#### \[navbar-brand\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| link      | The url you want the navbar-brand to link to                                                                                                    | optional | any valid link         | none    |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

The `[navbar-brand]` can be applied to most elements, but an anchor
works best as some elements might require utility classes or custom
styles.

#### \[navbar-toggler\] parameters

| Parameter | Description                                                                                                                                     | Required | Values   | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | -------- | ------- |
| class     | Any extra classes you want to add                                                                                                               | optional | any text | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text | none    |

`[navbar-toggler]` adds a button when the navigation bar is collapsed.
Navbar togglers are left-aligned by default, but should they follow a
sibling element like a `navbar-brand`, they’ll automatically be aligned
to the far
right.

#### \[navbar-content\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| link      | The url you want the navbar-content to link to                                                                                                  | optional | any valid link         | none    |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

`[nav-bar-content]` is used for grouping and hiding navbar contents by a
parent breakpoint.

-----

### Breadcrumbs

    [breadcrumb]
        [breadcrumb-item link="#"] Pictures [/breadcrumb-item]
        [breadcrumb-item link="#"] Vacation [/breadcrumb-item]
        [breadcrumb-item link="#" active] 2020 [/breadcrumb-item]
    [/breadcrumb]

#### \[breadcrumb\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[breadcrumb-item\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| link      | The url you want the breadcrumb-item to link to                                                                                                 | optional | any valid link         | \#      |
| active    | Whether the item has the "active" style applied                                                                                                 | optional | true, false            | false   |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap breadcrumb
documentation](https://getbootstrap.com/docs/4.6/components/breadcrumb/)

-----

### Badges

    [badge right] 10 [/badge]

#### \[badge\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| right     | Whether the badge should align to the right of its container                                                                                    | optional | 🚩 (flag)               |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap badge
documentation](https://getbootstrap.com/docs/4.6/components/badge/)

-----

### Jumbotron

    [jumbotron] [lorem-ipsum] [/jumbotron]

#### \[jumbotron\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| fluid     | Make jumbotron occupy the entire horizontal space of its parent                                                                                 | optional | 🚩 (flag)               |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap jumbotron
documentation](https://getbootstrap.com/docs/4.6/components/jumbotron/)

-----

### Alerts

    [alert type="danger"]  Danger  [/alert]

#### \[alert\] parameters

| Parameter   | Description                                                                                                                                     | Required | Values                                                          | Default |
| ----------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | --------------------------------------------------------------- | ------- |
| type        | The type of the alert                                                                                                                           | required | primary, secondary, success, info, warning, danger, dark, light | primary |
| dismissible | If the alert should be dismissible                                                                                                              | optional | 🚩 (flag)                                                        |         |
| fade        | If the alert should be animated when dismissed                                                                                                  | optional | 🚩 (flag)                                                        |         |
| class       | Any extra classes you want to add                                                                                                               | optional | any text                                                        | none    |
| data        | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text                                                        | none    |

[Bootstrap alert
documentation](https://getbootstrap.com/docs/4.6/components/alerts/)

-----

### Progress Bars

    [progress]
        [progress-bar striped percent="50"]
        [progress-bar striped percent="25" type="success"]
    [/progress]

#### \[progress\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[progress-bar\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                                                          | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | --------------------------------------------------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier                                          |         |
| percent   | The percentage amount to show in the progress bar                                                                                               | required | any number between 0 and 100                                    | false   |
| label     | Whether to show the percentage as a text label inside the bar                                                                                   | optional | 🚩 (flag)                                                        |         |
| type      | The type of the progress bar                                                                                                                    | optional | primary, secondary, success, info, warning, danger, light, dark | primary |
| striped   | Whether enclosed progress bars will be striped                                                                                                  | optional | 🚩 (flag)                                                        |         |
| animated  | Whether enclosed progress bars will be animated                                                                                                 | optional | 🚩 (flag)                                                        |         |
| title     | The title of the progress bar for screen readers                                                                                                | optional | Any text                                                        |         |
| minimum   | The minimum value of the progress bar for screen readers                                                                                        | optional | Any number                                                      | 0       |
| maximum   | The maximum value of the progress bar for screen readers                                                                                        | optional | Any number                                                      | 100     |
| class     | Any extra classes you want to add                                                                                                               | optional | any text                                                        | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text                                                        | none    |

[Bootstrap progress bars
documentation](https://getbootstrap.com/docs/4.6/components/progress/)

-----

### Media Objects

The tag `[media-outer]` allows to nest media objects inside a media
object.

    [media]
        [media-object class="mr-3"]
            [img responsive][img-gen size="150" text="Demo"][/img]
        [/media-object]
        [media-body]
            Header
            [lorem-ipsum sentences="3"]
        [/media-body]
    [/media]

#### \[media\] parameters

| Parameter  | Description                                                                                                                                     | Required | Values                 | Default |
| ---------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id         | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| list-group | Whether the media is part of a list group                                                                                                       | optional | 🚩 (flag)               |         |
| class      | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data       | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[media-object\] parameters

| Parameter | Description                                                                                                                                     | Required | Values             | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ------------------ | ------- |
| align     | Where the media should align with the text.                                                                                                     | optional | start, center, end | start   |
| class     | Any extra classes you want to add                                                                                                               | optional | any text           | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text           | none    |

#### \[media-body\] parameters

The tag `[media-body-outer]` allows to nest media objects inside a media
object
body.

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

**NOTE: `media-object` should contain an image, or linked image,
inserted using the WordPress TinyMCE editor or the `img-gen` tag.**

[Bootstrap media objects
documentation](https://getbootstrap.com/docs/4.6/components/media-object/)

-----

### List Groups

#### Basic Example

    [list-group]
        [list-group-item]
            [lorem-ipsum]
        [/list-group-item]
        [list-group-item]
            [lorem-ipsum]
        [/list-group-item]
        [list-group-item]
            [lorem-ipsum]
        [/list-group-item]
    [/list-group]

#### Linked Items

    [list-group linked]
        [list-group-item active]Active[/list-group-item]
        [list-group-item disabled]Disabled[/list-group-item]
        [list-group-item]Link 1[/list-group-item]
        [list-group-item]Link 2[/list-group-item]
    [/list-group]

#### Media Items

    [list-group media]
        [media list-group]
            [media-object class="mr-3"]
                [img responsive][img-gen size="150" text="Demo 1" bg="f00"][/img]
            [/media-object]
            [media-body]
                <h3>Header 1</h3>
                [lorem-ipsum sentences="3"]
            [/media-body]
        [/media]
        [media list-group class="mt-4"]
            [media-object class="mr-3"]
                [img responsive][img-gen size="150" text="Demo 2" bg="0f0"][/img]
            [/media-object]
            [media-body]
                <h3>Header 2</h3>
                [lorem-ipsum sentences="3"]
            [/media-body]
        [/media]
        [media list-group class="mt-4"]
            [media-object class="mr-3"]
                [img responsive][img-gen size="150" text="Demo 3" bg="00f"][/img]
            [/media-object]
            [media-body]
                <h3>Header 3</h3>
                [lorem-ipsum sentences="3"]
            [/media-body]
        [/media]
    [/list-group]​

#### \[list-group\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| linked    | Weather the list group contains links                                                                                                           | optional | 🚩 (flag)               |         |
| flush     | Remove some borders and rounded corners to render list group items edge-to-edge in a parent container (e.g. cards)                              | optional | 🚩 (flag)               |         |
| media     | Weather the list group contains media items                                                                                                     | optional | 🚩 (flag)               |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[list-group-item\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                                                                | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | --------------------------------------------------------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier                                                |         |
| type      | The type of the list-group-item                                                                                                                 | optional | primary, secondary, success, info, warning, danger, light, dark, link | none    |
| active    | Whether the item has the "active" style applied                                                                                                 | optional | 🚩 (flag)                                                              |         |
| disabled  | Whether the item is deactivated                                                                                                                 | optional | 🚩 (flag)                                                              |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text                                                              | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text                                                              | none    |

[Bootstrap list groups
documentation](https://getbootstrap.com/docs/4.6/components/list-group/)

-----

### Content

### Code

    [code] ... [/code]

#### \[code\] parameters

| Parameter  | Description                                                                                                                                     | Required | Values                 | Default |
| ---------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id         | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| inline     | Display inline code                                                                                                                             | optional | 🚩 (flag)               |         |
| scrollable | Set a max height of 350px and provide a scroll bar. Not usable with `inline`.                                                                   | optional | 🚩 (flag)               |         |
| class      | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data       | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap code
documentation](https://getbootstrap.com/docs/4.6/content/code/)

-----

### Tables

    [table-wrap bordered striped]
    
                Standard HTML table code goes here.
    
    [/table-wrap]

#### \[table-wrap\] parameters

| Parameter  | Description                                                                                                                                                                     | Required | Values                 | Default |
| ---------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id         | Name the container for processing in custom CSS or JavaScript.                                                                                                                  | optional | Unique text identifier |         |
| bordered   | Set "bordered" table style (see Bootstrap documentation)                                                                                                                        | optional | 🚩 (flag)               |         |
| striped    | Set "striped" table style (see Bootstrap documentation)                                                                                                                         | optional | 🚩 (flag)               |         |
| hover      | Set "hover" table style (see Bootstrap documentation)                                                                                                                           | optional | 🚩 (flag)               |         |
| condensed  | Set "condensed" table style (see Bootstrap documentation)                                                                                                                       | optional | 🚩 (flag)               |         |
| responsive | Wrap the table in a div with the class "table-responsive" (see [Bootstrap responsive table documentation](https://getbootstrap.com/docs/4.6/content/tables/#always-responsive)) | optional | 🚩 (flag)               |         |
| class      | Any extra classes you want to add                                                                                                                                               | optional | any text               | none    |
| data       | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters).                                 | optional | any text               | none    |

[Bootstrap table
documentation](https://getbootstrap.com/docs/4.6/content/tables/)

-----

### Images

    [img responsive]
        [img-gen size="200" file="png" bg="C00" color="ff0"]
    [/img]

Wrap any number of HTML image tags or images inserted via the WordPress
media manager or the `img-gen`
tag.

#### \[img\] parameters

| Parameter  | Description                                                                                                                                     | Required | Values   | Default |
| ---------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | -------- | ------- |
| center     | Center the wrapped image                                                                                                                        | optional | 🚩 (flag) |         |
| responsive | Make the wrapped images responsive                                                                                                              | optional | 🚩 (flag) |         |
| thumbnail  | Add a rounded 1px border appearance. Does not change the size of the image.                                                                     | optional | 🚩 (flag) |         |
| class      | Any extra classes you want to add                                                                                                               | optional | any text | none    |
| data       | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text | none    |

[Bootstrap images
documentation](https://getbootstrap.com/docs/4.6/content/images/)

-----

### Dynamic Dummy Image Generator

    [img-gen type="circle" responsive size="800x600" text="Hello"]

Generate dynamic dummy images with selectable colors and text.

#### \[img-gen\] parameters

<table>
<thead>
<tr class="header">
<th>Parameter</th>
<th>Description</th>
<th>Required</th>
<th>Values</th>
<th>Default</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td>type</td>
<td>The effect to apply to wrapped images</td>
<td>optional</td>
<td>rounded, circle, thumbnail</td>
<td>false</td>
</tr>
<tr class="even">
<td>responsive</td>
<td>Make the wrapped images responsive</td>
<td>optional</td>
<td>🚩 (flag)</td>
<td></td>
</tr>
<tr class="odd">
<td>size</td>
<td>The size of the image in pixels</td>
<td>optional</td>
<td>Examples: 500x250 (= 500px width, 250px height)<br />
500 (= 500px square)</td>
<td>640x480</td>
</tr>
<tr class="even">
<td>file</td>
<td>The image file type</td>
<td>optional</td>
<td>png, gif, jpg or jpeg</td>
<td>png</td>
</tr>
<tr class="odd">
<td>text</td>
<td>The text shown on top of the image</td>
<td>optional</td>
<td>Any text</td>
<td>{Width-Of-Image} x {Hight-Of-Image}</td>
</tr>
<tr class="even">
<td>bg</td>
<td>The background color of the image</td>
<td>optional</td>
<td>Examples:<br />
f00 (= #FF0000 as background color)<br />
FF0855 (= #FF0855 as background color)</td>
<td>000080</td>
</tr>
<tr class="odd">
<td>color</td>
<td>The font color of the image</td>
<td>optional</td>
<td>see bg color</td>
<td>FFFFFF</td>
</tr>
<tr class="even">
<td>class</td>
<td>Any extra classes you want to add</td>
<td>optional</td>
<td>any text</td>
<td>none</td>
</tr>
<tr class="odd">
<td>data</td>
<td>Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at <a href="#container-parameters">[container] parameters</a>.</td>
<td>optional</td>
<td>any text</td>
<td>none</td>
</tr>
</tbody>
</table>

[Bootstrap images
documentation](https://getbootstrap.com/docs/4.6/content/images/)

-----

### Figures

    [figure]
      [img-gen size="300" class="figure-img img-fluid rounded"]
      [figure-caption]A caption for the above image.[/figure-caption]
    [/figure]

#### \[figure\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[figure-caption\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap figures
documentation](https://getbootstrap.com/docs/4.6/content/figures/)

-----

### Blockquote

    [blockquote]
        The quote goes here...
        [blockquote-footer]
            The source goes here...
        [/blockquote-footer]
    [/blockquote]

#### \[blockquote\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[blockquote-footer\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap blockquote
documentation](https://getbootstrap.com/docs/4.6/content/typography/#blockquotes)

-----

### Lead body copy

    [lead] [lorem-ipsum] [/lead]

#### \[lead\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap lead
documentation](https://getbootstrap.com/docs/4.6/content/typography/#lead)

-----

### Wrap section

    [wrapper type="span" class="d-flex text-success"] [icon name="arrow-right" class="fa-2x mr-2"][lorem-ipsum] [/wrapper]

#### \[wrapper\] parameters

| Parameter | Description                                                                                                                                                      | Required | Values                 | Default |
| --------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| type      | The HTML element to wrap the section with.                                                                                                                       | optional | Any HTML element       | div     |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                                   | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                                                | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. Example: `data="columns,3\|index,1"` expands to `data-columns="3" data-index="1"`. | optional | any text               | none    |

[Bootstrap lead
documentation](https://getbootstrap.com/docs/4.6/content/typography/#lead)

-----

### Utilities

### Border

Use border utilities to quickly style the `border`, `border-radius`,
`border-size` and `border-color` of an element. Great for images,
buttons, or any other element.

    [border radius="pill" color="danger"]
        [lorem-ipsum class="p-3"]
    [/border]

#### \[border\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                                                                              | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ----------------------------------------------------------------------------------- | ------- |
| add       | The border(s) to add                                                                                                                            | optional | all, top, right, bottom, left                                                       | all     |
| del       | The border(s) to subtract                                                                                                                       | optional | all, top, right, bottom, left                                                       | none    |
| radius    | The border radius to display                                                                                                                    | optional | all, top, right, bottom, left, circle, pill                                         | none    |
| size      | The size of the border radius                                                                                                                   | optional | sm, md, lg                                                                          | md      |
| color     | The color of the border                                                                                                                         | optional | primary, secondary, success, danger, warning, info, light, dark, body, muted, white |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text                                                                            | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text                                                                            | none    |

[Bootstrap border classes
documentation](https://getbootstrap.com/docs/4.6/utilities/borders/)

-----

### Color

Use color utilities to quickly style the `text color` and `background
color` of an
element.

    [color text="success"] [lorem-ipsum] [/color]

#### \[color\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                                                                                                  | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ------------------------------------------------------------------------------------------------------- | ------- |
| text      | The text color to display                                                                                                                       | optional | primary, secondary, success, danger, warning, info, light, dark, body, muted, white, black-50, white-50 | none    |
| bg        | The background color to display                                                                                                                 | optional | primary, secondary, success, danger, warning, info, light, dark, white, transparent                     | none    |
| class     | Any extra classes you want to add                                                                                                               | optional | any text                                                                                                | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text                                                                                                | none    |

[Bootstrap color classes
documentation](https://getbootstrap.com/docs/4.6/utilities/colors/)

-----

### Flex

    [flex size="lg" inline row-reverse="xs sm md" class="p-3 bg-secondary text-white"]
        [flex-item class="p-2 bg-info"]Flex item 1[/flex-item]
        [flex-item class="p-2 bg-warning"]Flex item 2[/flex-item]
        [flex-item class="p-2 bg-primary"]Flex item 3[/flex-item]
    [/flex]

#### \[flex\] parameters

| Parameter     | Description                                                                                                                                     | Required | Values                                       | Default |
| ------------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | -------------------------------------------- | ------- |
| id            | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier                       |         |
| inline        | Set the inline style for the flex container (only takes up as much width as necessary)                                                          | optional | 🚩 (flag)                                     |         |
| direction     | Set the direction for the flex items                                                                                                            | optional | row, row-reverse, column, column-reverse     | row     |
| justify       | Change the alignment of flex items on the main axis                                                                                             | optional | start, end, center, between, around          |         |
| align-content | Set flexbox container to align flex items together on the cross axis. This property has no effect on single rows of flex items.                 | optional | start, end, center, between, around, stretch | start   |
| align-items   | Change the alignment of flex items on the cross axis (the y-axis to start, x-axis if flex-direction column).                                    | optional | start, end, center, baseline, stretch        | start   |
| wrap          | Set how flex items wrap in a flex container.                                                                                                    | optional | true, reverse                                | false   |
| class         | Any extra classes you want to add                                                                                                               | optional | any text                                     | none    |
| data          | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text                                     | none    |

#### \[flex-item\] parameters

| Parameter | Description                                                                                                                                                              | Required | Values                                | Default |
| --------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | -------- | ------------------------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                                           | optional | Unique text identifier                |         |
| align     | Align individual flex items on the cross axis.                                                                                                                           | optional | start, end, center, baseline, stretch | start   |
| fill      | Force elements into widths equal to their content (or equal widths if their content does not surpass their border-boxes) while taking up all available horizontal space. | optional | 🚩 (flag)                              |         |
| grow      | Allow flex item ability to grow to fill available space.                                                                                                                 | optional | 🚩 (flag)                              |         |
| no-grow   | Disallow flex item ability to grow to fill available space.                                                                                                              | optional | 🚩 (flag)                              |         |
| shrink    | Allow flex item ability to shrink if forced by other elements.                                                                                                           | optional | 🚩 (flag)                              |         |
| no-shrink | Disallow flex item ability to shrink if forced by other elements.                                                                                                        | optional | 🚩 (flag)                              |         |
| class     | Any extra classes you want to add                                                                                                                                        | optional | any text                              | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters).                          | optional | any text                              | none    |

[Bootstrap flex
documentation](https://getbootstrap.com/docs/4.6/utilities/flex/)

-----

### HTML snippets

Allow any html code. This shortcode has no parameters.

    [html]<hr class="m-5">[/html]

-----

### Line Breaks

Insert line break. The plugin tries very aggressively to eliminate all
line breaks inserted by the editor. Use this shortcode to add
intentional line breaks. This shortcode has no parameters.

    [br]

-----

### Lorem Ipsum text generator

Generate any amount of `lorem ipsum` data. Great for layout tests.
Without any parameters, the tag will produce one sentence with the `p`
tag.

    [lorem-ipsum sentences="3" tag="div"]

#### \[lorem-ipsum\] parameters

| Parameter  | Description                                                                                                                                     | Required | Values                                                    | Default |
| ---------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | --------------------------------------------------------- | ------- |
| tag        | The element tag for the text snippets.                                                                                                          | optional | any element tag; use `span` to keep the elements together | p       |
| words      | The number of words to generate                                                                                                                 | optional | any number                                                | none    |
| sentences  | The number of sentences to generate                                                                                                             | optional | any number                                                | none    |
| paragraphs | The number of paragraphs to generate                                                                                                            | optional | any number                                                | none    |
| class      | Any extra classes you want to add                                                                                                               | optional | any text                                                  | none    |
| data       | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text                                                  | none    |

-----

### Floats and Clearfix

Quickly and easily clear floated content within a container.

    [clearfix]
    [float float="left"] Floating Left [/float]
    [float float="right"] Floating Right [/float]
    [/clearfix]

#### \[clearfix\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[float\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| float     | Position to float the elemet to.                                                                                                                | optional | none, left, right      | none    |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

-----

### Javascript

### Tooltip

    [tooltip title="I'm the tooltip title" placement="auto"] Hover over me [/tooltip]

#### \[tooltip\] parameters

| Parameter | Description                                | Required | Values                         | Default |
| --------- | ------------------------------------------ | -------- | ------------------------------ | ------- |
| title     | The title of the tooltip                   | required | any text                       | none    |
| placement | The placement of the tooltip               | optional | auto, left, top, bottom, right | right   |
| animation | Apply a CSS fade transition to the tooltip | optional | 🚩 (flag)                       |         |
| html      | Allow HTML in the tooltip text             | optional | 🚩 (flag)                       |         |

[Bootstrap tooltip
documentation](https://getbootstrap.com/docs/4.6/components/tooltips/)

-----

### Popover

    [popover title="I'm the title" content="And this is the content" placement="auto" animation]
        [button outline class="mr-3"] Click Me [/button]
    [/popover]

#### \[popover\] parameters

| Parameter | Description                                | Required | Values                         | Default |
| --------- | ------------------------------------------ | -------- | ------------------------------ | ------- |
| title     | The title of the popover                   | optional | any text                       | none    |
| content   | The text of the popover                    | required | any text                       | none    |
| placement | The placement of the popover               | optional | auto, left, top, bottom, right | right   |
| animation | Apply a CSS fade transition to the tooltip | optional | 🚩 (flag)                       |         |
| html      | Allow HTML in the popover text             | optional | 🚩 (flag)                       |         |
| trigger   | Allow HTML in the popover text             | optional | click, hover, focus, manual    | click   |

[Bootstrap popovers
documentation](https://getbootstrap.com/docs/4.6/components/popovers/)

-----

### Collapse

##### Accordion example

Create an accordion by wrapping `[card]`s in `[accordion]`.

    [accordion]
        [card show]
            [card-header] Header 1 [/card-header]
            [card-body] [lorem-ipsum] [/card-body]
        [/card]
        [card]
            [card-header] Header 2 [/card-header]
            [card-body][lorem-ipsum][/card-body]
        [/card]
        [card]
            [card-header] Header 3 [/card-header]
            [card-body][lorem-ipsum][/card-body]
        [/card]
    [/accordion]

#### \[accordion\] parameters

| Parameter | Description                                                                   | Required | Values                 | Default         |
| --------- | ----------------------------------------------------------------------------- | -------- | ---------------------- | --------------- |
| id        | Name the container for processing in custom CSS or JavaScript.                | optional | Unique text identifier | accordion\#\#\# |
| class     | Any extra classes you want to add.                                            | optional | any text               |                 |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. | optional | any text               |                 |

[Bootstrap collapse
documentation](https://getbootstrap.com/docs/4.6/components/collapse/)

-----

### Carousel

    [carousel]
        [carousel-item active]
            [img-gen responsive size="1200x200" text=" "]
            [carousel-caption] Caption 1 [/carousel-caption]        
        [/carousel-item]
        [carousel-item]
            [img-gen responsive size="1200x200" text=" " bg="C0C0C0"]
            [carousel-caption] Caption 2 [/carousel-caption]        
        [/carousel-item]
        [carousel-item]
            [img-gen responsive size="1200x200" text=" " bg="F00000"]
            [carousel-caption] Caption 3 [/carousel-caption]        
        [/carousel-item]
        [carousel-item][
            img-gen responsive size="1200x200" text=" " bg="00F000"]
            [carousel-caption] Caption 4 [/carousel-caption]        
        [/carousel-item]
    [/carousel]

\[carousel-item\] wraps an HTML image tag, image inserted via the
WordPress editor or the `img-gen` tag. It can also be used for text
slides but you may need to use additional utilities or custom styles to
appropriately size
content.

#### \[carousel\] parameters

| Parameter  | Description                                                                                                                                                           | Required | Values                        | Default             |
| ---------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ----------------------------- | ------------------- |
| id         | Name the container for processing in custom CSS or JavaScript.                                                                                                        | optional | Unique text identifier        | bs4-carousel-\#\#\# |
| interval   | The amount of time to delay between automatically cycling an item. If false, carousel will not automatically cycle.                                                   | optional | any number (in ms) or "false" | 5000                |
| pause      | Pauses the carousel from going through the next slide when the mouse pointer enters the carousel, and resumes the sliding when the mouse pointer leaves the carousel. | optional | hover, false                  | hover               |
| wrap       | Whether the carousel should cycle continuously or have hard stops.                                                                                                    | optional | true, false                   | true                |
| indicators | Whether the carousel should show the slide indicator.                                                                                                                 | optional | 🚩 (flag)                      |                     |
| controls   | Whether the carousel should show the previous and next slide controls.                                                                                                | optional | 🚩 (flag)                      |                     |
| fade       | To animate slides with a fade transition instead of a slide.                                                                                                          | optional | 🚩 (flag)                      |                     |
| class      | Any extra classes you want to add                                                                                                                                     | optional | any text                      | none                |
| data       | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters).                       | optional | any text                      | none                |

#### \[carousel-item\] parameters

Parameter

Description

Required

Values

Default

id

Name the container for processing in custom CSS or JavaScript.

optional

Unique text identifier

active

Whether the item has the "active" style applied. One item MUST be set as
active.

optional

🚩 (flag)

class

Any extra classes you want to add

optional

any text

none

data

Data attribute and value pairs separated by a comma. Pairs separated by
pipe. See example at [\[container\] parameters](#container-parameters).

optional

any
text

none

#### \[carousel-caption\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap carousel
documentation](https://getbootstrap.com/docs/4.6/components/carousel/)

-----

### Modal

    [button type="info" modal="example-modal-sm"] Modal Action [/button]
    [modal size="sm" fade id="example-modal-sm"]
        [modal-header]Example Header[/modal-header]
        [modal-body]
            [lorem-ipsum]
        [/modal-body]
        [modal-footer]
            [button type="secondary"] Lorem [/button]
            [button type="primary"] Ipsum [/button]
        [/modal-footer]
    [/modal]

#### \[modal\] parameters

| Parameter  | Description                                                                                                                                     | Required | Values                 | Default                                  |
| ---------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ---------------------------------------- |
| id         | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier | modal-\#\#\#                             |
| fade       | Slide modal down and fade in from the top of the page                                                                                           | optional | 🚩 (flag)               |                                          |
| centered   | Vertically center the modal                                                                                                                     | optional | 🚩 (flag)               |                                          |
| scrollable | Allows scrolling the modal body                                                                                                                 | optional | 🚩 (flag)               |                                          |
| size       | Optional modal size                                                                                                                             | optional | sm, lg, xl             | Default                                  |
| id         | Unique id for the modal (see `modal` at [Buttons](#buttons)                                                                                     | required | any text without space | modal-{counter}; {counter} starting at 0 |
| backdrop   | Apply the modal "backdrop" style; `static` will not close the modal when clicking outside of it                                                 | optional | false, true, static    | true                                     |
| keyboard   | Closes the modal when escape key is pressed                                                                                                     | optional | false, true            | true                                     |
| class      | Any extra classes you want to add to the trigger link                                                                                           | optional | any text               | none                                     |
| data       | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none                                     |

#### \[modal-header\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[modal-body\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

#### \[modal-footer\] parameters

| Parameter | Description                                                                                                                                     | Required | Values                 | Default |
| --------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------- | ------- |
| id        | Name the container for processing in custom CSS or JavaScript.                                                                                  | optional | Unique text identifier |         |
| class     | Any extra classes you want to add                                                                                                               | optional | any text               | none    |
| data      | Data attribute and value pairs separated by a comma. Pairs separated by pipe. See example at [\[container\] parameters](#container-parameters). | optional | any text               | none    |

[Bootstrap modal
documentation](https://getbootstrap.com/docs/4.6/components/modal/)

-----
