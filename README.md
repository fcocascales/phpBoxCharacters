# BoxCharacters

Generate text tables with utf8 box characters

## Example

### 1) Input text/plain

```text
Lorem ipsum; Dolor sit amet; Consectetur; Adipisicing elit
Sed do eiusmod tempor; ; Ut labore et; Dolore magna aliqua.
Ut enim; Ad minim veniam; Quis nostrud; Exercitation ullamco
Laboris nisi; Ut aliquip; ; Commodo consequat
Duis aute irure; Dolor in; Reprehenderit
Esse cillum; Dolore eu; Fugiat nulla; Pariatur
Excepteur
Sunt in culpa; Qui officia deserunt; Mollit anim; Id est laborum
```

#### 1.1) Configuration
```
┌───────────┬─────────────────┐
│ Style     │ **thick**       │
├───────────┼─────────────────┤
│ Layout    │ **grid**        │
├───────────┼─────────────────┤
│ Padding   │ **1** character │
├───────────┼─────────────────┤
│ Separator │ **;**           │
└───────────┴─────────────────┘
```

### 2) Output text/plain

```text
┌───────────────────────┬──────────────────────┬───────────────┬──────────────────────┐
│ Lorem ipsum           │ Dolor sit amet       │ Consectetur   │ Adipisicing elit     │
├───────────────────────┼──────────────────────┼───────────────┼──────────────────────┤
│ Sed do eiusmod tempor │                      │ Ut labore et  │ Dolore magna aliqua. │
├───────────────────────┼──────────────────────┼───────────────┼──────────────────────┤
│ Ut enim               │ Ad minim veniam      │ Quis nostrud  │ Exercitation ullamco │
├───────────────────────┼──────────────────────┼───────────────┼──────────────────────┤
│ Laboris nisi          │ Ut aliquip           │               │ Commodo consequat    │
├───────────────────────┼──────────────────────┼───────────────┼──────────────────────┤
│ Duis aute irure       │ Dolor in             │ Reprehenderit │                      │
├───────────────────────┼──────────────────────┼───────────────┼──────────────────────┤
│ Esse cillum           │ Dolore eu            │ Fugiat nulla  │ Pariatur             │
├───────────────────────┼──────────────────────┼───────────────┼──────────────────────┤
│ Excepteur             │                      │               │                      │
├───────────────────────┼──────────────────────┼───────────────┼──────────────────────┤
│ Sunt in culpa         │ Qui officia deserunt │ Mollit anim   │ Id est laborum       │
└───────────────────────┴──────────────────────┴───────────────┴──────────────────────┘
```

## Styles
```
┌──┬──┐ fine
│  │  │
├──┼──┤
│  │  │
└──┴──┘
┏━━┳━━┓ thick
┃  ┃  ┃
┣━━╋━━┫
┃  ┃  ┃
┗━━┻━━┛
┍━━┯━━┑ thick fine
│  │  │
┝━━┿━━┥
│  │  │
┕━━┷━━┙
┎──┰──┒ fine thick
┃  ┃  ┃
┠──╂──┨
┃  ┃  ┃
┖──┸──┚
╔══╦══╗ double
║  ║  ║
╠══╬══╣
║  ║  ║
╚══╩══╝
╒══╤══╕ double fine
│  │  │
╞══╪══╡
│  │  │
╘══╧══╛
╓──╥──╖ fine double
║  ║  ║
╟──╫──╢
║  ║  ║
╙──╨──╜
+--+--+ math
|  |  |
+--+--+
|  |  |
+--+--+
╭──┬──╮ rounded
│  │  │
├──┼──┤
│  │  │
╰──┴──╯
```

## Layouts
```
┌──┬──┬──┐ grid
├──┼──┼──┤
├──┼──┼──┤
└──┴──┴──┘
┌──┬──┬──┐ columns
│  │  │  │
│  │  │  │
└──┴──┴──┘
┌────────┐ rows
├────────┤
├────────┤
└────────┘
┌────────┐ box
│        │
│        │
└────────┘
   │  │    cross
───┼──┼───
───┼──┼───
   │  │
```
