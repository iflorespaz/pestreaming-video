<?php

namespace App\Controller;

use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

final class CreateMediaObjectActionController extends AbstractController
{
    public EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): Media
    {
        $uploadedFile = $request->files->get('file');
        $name = $request->get('name');
        $description = $request->get('description');
        $status = (bool)$request->get('status');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $mediaObject = new Media();
        $mediaObject->setName($name);
        $mediaObject->setDescription($description);
        $mediaObject->setStatus($status);
        $mediaObject->setCreatedAt(new \DateTimeImmutable('now'));
        $mediaObject->setUpdatedAt(new \DateTimeImmutable('now'));
        $mediaObject->cover = $uploadedFile;
        $this->entityManager->persist($mediaObject);
        $this->entityManager->flush();

        return $mediaObject;
    }
}
