<?php
/**
 * Date: 31.10.16
 *
 * @author Portey Vasil <portey@gmail.com>
 */

namespace AppBundle\GraphQL\Mutation\Todo;


use AppBundle\GraphQL\Type\TodoType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class DestroyField extends AbstractContainerAwareField
{

    public function build(FieldConfig $config)
    {
        $config->addArguments([
            'id' => new NonNullType(new IdType())
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        return $this->container->get('resolver.todo')->destroy($args['id']);
    }

    /**
     * @return AbstractObjectType|AbstractType
     */
    public function getType()
    {
        return new ListType(new TodoType());
    }
}