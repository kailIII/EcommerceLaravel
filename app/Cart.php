<?php namespace LaravelCommerce;

class Cart
{

	private $items;

	public function __construct()
	{
		$this->items = [];
	}

	public function add($id, $name, $price)
	{
		$this->items += [
			$id => [
				'qtd' => isset($this->items[$id]['qtd']) ? $this->items[$id]['qtd']++ : 1,
				'price' => $price,
				'name' => $name
			]
		];
		return $this->items;
	}

	public function update($id, $qtd)
	{
		$this->items[$id]['qtd'] = $qtd;

		$resultJSON = $this->items[$id];
		$resultJSON['itemtotal'] =  number_format($resultJSON['qtd'] * $resultJSON['price'],2,'.',',');
        $resultJSON['carttotal'] =  number_format($this->getTotal(),2,'.',',');

		return json_encode($resultJSON);
	}

	public function remove($id)
	{
		unset($this->items[$id]);
	}

	public function all()
	{
		return $this->items;
	}

	public function getTotal()
	{
		$total = 0;
		foreach ($this->items as $item) {
			$total += $item['qtd'] * $item['price'];
		}
		return $total;
	}

	public function clear()
	{
		$this->items = array();
	}
}