<?php
	/*
		┌──┬──┐
		│  │  │
		├──┼──┤
		│  │  │
		└──┴──┘
		┏━━┳━━┓   ┍━━┯━━┑   ┎──┰──┒
		┃  ┃  ┃   │  │  │   ┃  ┃  ┃
		┣━━╋━━┫   ┝━━┿━━┥   ┠──╂──┨
		┃  ┃  ┃   │  │  │   ┃  ┃  ┃
		┗━━┻━━┛   ┕━━┷━━┙   ┖──┸──┚
    ╔══╦══╗   ╒══╤══╕   ╓──╥──╖
    ║  ║  ║   │  │  │   ║  ║  ║
    ╠══╬══╣   ╞══╪══╡   ╟──╫──╢
    ║  ║  ║   │  │  │   ║  ║  ║
    ╚══╩══╝   ╘══╧══╛   ╙──╨──╜
	*/

	class BoxChars {

		const BOX = array(
			"┌┬┐". // style0=fine
			"├┼┤".
			"└┴┘"."─│",
			"┏┳┓". // style1=thick
			"┣╋┫".
			"┗┻┛"."━┃",
			"┍┯┑". // style2=fine thick
			"┝┿┥".
			"┕┷┙"."━│",
			"┎┰┒". // style3=thick fine
			"┠╂┨".
			"┖┸┚"."─┃",
			"╔╦╗". // style4=double
			"╠╬╣".
			"╚╩╝"."═║",
			"╒╤╕". // style5=double fine
			"╞╪╡".
			"╘╧╛"."═│",
	 		"╓╥╖". // style6=fine double
			"╟╫╢".
			"╙╨╜"."─║",
	 		"+++". // style7=math
			"+++".
			"+++"."-|",
			"╭┬╮". // style8=rounded
			"├┼┤".
			"╰┴╯"."─│",
		);

		const STYLE_FINE = 0;
		const STYLE_THICK = 1;
		const STYLE_DOUBLE = 4;
		const STYLE_CROSS = 7;
		const STYLE_FULL = 8;

		const TOP_LEFT = 0;
		const BEGIN_VERT = 1;
		const TOP_RIGHT = 2;
		const BEGIN_HORIZ = 3;
		const CROSS = 4;
		const END_HORIZ = 5;
		const BOTTOM_LEFT = 6;
		const END_VERT = 7;
		const BOTTOM_RIGHT = 8;
		const HORIZONTAL = 9;
		const VERTICAL = 10;

		const LAYOUT_GRID = 0;
		const LAYOUT_COLUMNS = 1;
		const LAYOUT_ROWS = 2;
		const LAYOUT_BOX = 3;
		const LAYOUT_CROSS = 4;

		// Properties
		private $text;
		private $style;
		private $layout;
		private $padding;
		private $separator;

		// Calculation
		protected $widths;
		protected $format; // text|html

		public function __construct($text="", $style=0, $layout=0, $padding=1) {
			$this->setText($text);
			$this->setStyle($style);
			$this->setLayout($layout);
			$this->setPadding($padding);
			$this->widths = array();
			$this->separator = ';';
		}

		// TEST

		// SETTERS

		public function setText($value) {
			$this->text = $value;
		}
		public function setStyle($value) {
			$value = intval($value);
			if ($value >= 0 && $value < count(self::BOX)) {
				$this->style = $value;
			}
		}
		public function setLayout($value) {
			$value = intval($value);
			if ($value >= 0 && $value <= self::LAYOUT_CROSS) {
				$this->layout = $value;
			}
		}
		public function setPadding($value) {
			$value = intval($value);
			if ($value >= 0 && $value < 100) {
				$this->padding = $value;
			}
		}
		public function setSeparator($value) {
			$this->separator = substr($value, 0, 1);
		}

		//---------------------------------------------
		// GETTERS

		public function getText() { return $this->text; }
		public function getStyle() { return $this->style;	}
		public function getLayout() {	return $this->layout; }
		public function getPadding() { return $this->padding;	}
		public function getSeparator() { return $this->separator;	}

		//---------------------------------------------
		// FINAL RESULT

		public function html() {
			$this->format = 'html';
			return "<pre><code>".$this->textilize()."</code></pre>";
		}

		public function text() {
			$this->format = 'text';
			return $this->textilize();
		}

		protected function textilize() {
			$table = $this->tabulate();
			$table = $this->normalize($table);
			$text = $this->top_line();
			$vertical = $this->layout == self::LAYOUT_CROSS? " ":	$this->box(self::VERTICAL);
			foreach($table as $r=>$row) {
				$text .= $vertical;
				foreach($row as $c=>$cell) {
					$text .= $this->text_cell($c, $cell);
					$isLastCell = $c == count($row)-1;
					$text .= $this->text_vertical($vertical, $isLastCell);
				}
				$text .= "\n";
				$isLastRow = $r >= count($table)-1;
				if ($isLastRow)	$text .= $this->bottom_line();
				else $text .= $this->medium_line();
			}
			return $text;
		}

		private function text_cell($column, $value) {
			$numSpaces = $this->widths[$column] - mb_strlen($value);
			$spaces = $numSpaces > 0? str_repeat(" ", $numSpaces): "";
			if ($this->format == 'html') $value = htmlentities($value);
			return "$value$spaces";
		}
		private function text_vertical($vertical, $isLastCell) {
			if ($isLastCell) return $vertical;
			elseif ($this->layout == self::LAYOUT_ROWS
				|| $this->layout == self::LAYOUT_BOX) return " ";
			else return $this->box(self::VERTICAL);
		}

		//---------------------------------------------
		// PREPARATION

		/*
			Convert text in array (rows) of arrays (cells)
			and calculate maximum width of each cell
		*/
		protected function tabulate() {
			$table = explode("\n", $this->text);
			$this->widths = array();
			$spaces = str_repeat(" ", $this->padding);
			foreach($table as &$row) {
				$row = explode($this->separator, $row);
				foreach($row as $c=>&$cell) {
					$cell = trim($cell);
					$cell = "$spaces$cell$spaces";
					$length = mb_strlen($cell);
					if (!isset($this->widths[$c]))
						$this->widths[$c] = $length;
					elseif ($length > $this->widths[$c])
						$this->widths[$c] = $length;
				}
			}
			return $table;
		}

		/*
			Same number of cells on each row
		*/
		protected function normalize($table) {
			$cols = count($this->widths);
			foreach($table as $r=>&$row) {
				$count = $cols - count($row);
				for ($i=0; $i<$count; ++$i) {
					$row[] = "";
				}
			}
			return $table;
		}

		//---------------------------------------------
		// HORIZONTAL BOX LINES

		protected function top_line() {
			if ($this->layout == self::LAYOUT_CROSS) {
				return $this->cross_line();
			}
			return $this->line(
				$this->box(self::TOP_LEFT),
				$this->box(self::BEGIN_VERT),
				$this->box(self::TOP_RIGHT),
				$this->box(self::HORIZONTAL)
			);
		}
		protected function medium_line() {
			switch ($this->layout) {
				case self::LAYOUT_COLUMNS: return "";
				case self::LAYOUT_BOX: return "";
			}
			return $this->line(
				$this->box(self::BEGIN_HORIZ),
				$this->box(self::CROSS),
				$this->box(self::END_HORIZ),
				$this->box(self::HORIZONTAL)
			);
		}
		protected function bottom_line() {
			if ($this->layout == self::LAYOUT_CROSS) {
				return $this->cross_line();
			}
			return $this->line(
				$this->box(self::BOTTOM_LEFT),
				$this->box(self::END_VERT),
				$this->box(self::BOTTOM_RIGHT),
				$this->box(self::HORIZONTAL)
			);
		}
		private function cross_line() {
			return $this->line(
				" ",
				$this->box(self::VERTICAL),
				" ",
				" "
			);
		}
		protected function line($begin, $middle, $end, $repeat) {
			if ($this->layout == self::LAYOUT_ROWS
			 || $this->layout == self::LAYOUT_BOX) $middle = $repeat;
			$text = "";
			$text .= $begin;
			$count = count($this->widths);
			foreach($this->widths as $width) {
				$text .= str_repeat($repeat, $width);
				if (--$count==0) break;
				$text .= $middle;
			}
			$text .= $end;
			return "$text\n";
		}

		//---------------------------------------------
		// SINGLE BOX CHARACTER

		protected function box($index) {
			if ($this->layout == self::LAYOUT_CROSS) {
				switch ($index) {
					case self::BEGIN_HORIZ:
					case self::END_HORIZ:
						return mb_substr(self::BOX[$this->style], self::HORIZONTAL, 1);
				}
			}
			return mb_substr(self::BOX[$this->style], $index, 1);
		}

	}
