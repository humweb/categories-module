<?php
namespace Humweb\Categories\Presenter;

/**
 * AdminPresenter
 *
 * @package ${NAMESPACE}
 */
class AdminPresenter
{

    /**
     * Render nested list
     *
     * @param \Illuminate\Database\Eloquent\Collection|array $roots
     * @param int                                            $max_depth
     *
     * @return string
     */
    public function toNestable($roots, $max_depth)
    {
        $html = '';
        foreach ($roots as $node) {
            $html .= $this->renderNode($node, $max_depth)."\n";
        }

        return $html ? "\n<ol class=\"dd-list dd3-list\">\n$html</ol>\n" : null;
    }


    /**
     * @param \Baum\Node $node
     * @param int        $max_depth
     *
     * @return string
     */
    public function renderNode($node, $max_depth)
    {
        $children_html = '';
        if ( ! $node->isLeaf()) {
            $children_html = '\n<ol class="dd-list dd3-list">\n';
            foreach ($node->children as $child) {
                $children_html .= $this->renderNode($child, $max_depth);
            }
            $children_html .= "</ol>\n";
        }

        return '<li class="dd-item dd3-item nested-list-item" data-id="'.$node->id.'">'.'<div class="dd-handle dd3-handle">Handle</div>'.'<div class="dd3-content">'.$node->title.'<div class="actions nested-list-actions pull-right">'.'<ul class="list-inline">'.'<li><a href="#"><i class="fa fa-plus"></i></a></li>'.'<li><a href="#"><i class="fa fa-pencil"></i></a></li>'.'<li><a href="#"><i class="fa fa-trash"></i></a></li>'.'</ul></div></div>'.$children_html.'</li>';
    }

}