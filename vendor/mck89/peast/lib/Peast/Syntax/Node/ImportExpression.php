<?php
/**
 * This file is part of the Peast package
 *
 * (c) Marco Marchiò <marco.mm89@gmail.com>
 *
 * For the full copyright and license information refer to the LICENSE file
 * distributed with this source code
 */
namespace Peast\Syntax\Node;

/**
 * A node that represents an import expression (dynamic import).
 * 
 * @author Marco Marchiò <marco.mm89@gmail.com>
 */
class ImportExpression extends Node implements Expression
{
    /**
     * Map of node properties
     * 
     * @var array 
     */
    protected $propertiesMap = array(
<<<<<<< HEAD
        "source" => true,
        "options" => true
    );
    
    /**
     * The import source
=======
        "source" => true
    );
    
    /**
     * The catch clause parameter
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     * 
     * @var Expression
     */
    protected $source;
    
    /**
<<<<<<< HEAD
     * Optional import options
     * 
     * @var Expression|null
     */
    protected $options;
    
    /**
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     * Returns the import source
     * 
     * @return Expression
     */
    public function getSource()
    {
        return $this->source;
    }
    
    /**
     * Sets the import source
     * 
     * @param Expression $source Import source
     * 
     * @return $this
     */
    public function setSource(Expression $source)
    {
        $this->source = $source;
        return $this;
    }
<<<<<<< HEAD
    
    /**
     * Returns the import options
     * 
     * @return Expression|null
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * Sets the import options
     * 
     * @param Expression|null $options Import options
     * 
     * @return $this
     */
    public function setOptions($options)
    {
        $this->assertType($options, "Expression", true);
        $this->options = $options;
        return $this;
    }
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}