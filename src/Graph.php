<?php 

namespace Dsx;

class Graph
{
	protected $graph_vertices;

	protected $graph_edges;

	public function __construct(mixed $vertices)
	{
		$this->graph_vertices = new \Ds\Vector($vertices);
		$this->graph_edges = new \Ds\Map();

		if(is_array($vertices) || $vertices instanceof \Traversable) {
			foreach($vertices as $vertex) {
				$this->graph_edges->put($vertex, new \Ds\Vector());
			}
		}
	}

	public function get_vertices(string $args = null)
	{
		return $this->graph_vertices;
	}

	public function add_edge(mixed $vertex, mixed $neighbours)
	{
		if(!empty($this->graph_edges)) {
			$vector = $this->graph_edges->get($vertex);

			if(is_array($neighbours)) {

				foreach($neighbours as $neighbour) {
					$stack = new \Ds\Stack();
					$stack->push($neighbour);
					$vector->push($stack);

					foreach($this->graph_edges as $edge) {
						foreach($edge as $checking) {
							if($checking->peek() == $vertex) {
								$checking->push($neighbour);
							}
						}
					}
				}
			}
		}
	}

	public function remove_edge(mixed $vertex1, mixed $vertex2) {}

	public function adjacent(mixed $vertex1, mixed $vertex2) {}

	public function neighbours(mixed $vertex) {}

	public function add_vertex(mixed $vertex) {}

	public function remove_vertex(mixed $vertex) {}

	public function shorter_path(mixed $vertex1, mixed $vertex2) {}

	public function longer_path(mixed $vertex1, mixed $vertex2) {}
}