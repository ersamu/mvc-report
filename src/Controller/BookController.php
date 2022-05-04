<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;

class BookController extends AbstractController
{
    /**
     * @Route("/book", name="book_start")
     */
    public function bookIndex(): Response
    {
        return $this->render("book/index.html.twig");
    }

    /**
     * @Route("/book/add", name="add_book", methods={"GET","HEAD"})
     */
    public function addBook(): Response
    {
        return $this->render("book/add-book.html.twig");
    }

    /**
     * @Route("/book/add", name="add_book_process", methods={"POST"})
     */
    public function addBookProcess(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $entityManager = $doctrine->getManager();

        $title = $request->request->get("title");
        $isbn = $request->request->get("isbn");
        $author = $request->request->get("author");
        $image = $request->request->get("image");

        $book = new Book();
        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImage($image);

        // tell Doctrine you want to (eventually) save the Book
        // (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->redirectToRoute("book_show_all");
    }

    /**
     * @Route("/book/show", name="book_show_all")
    */
    public function showAllBook(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();

        $data = [
            "books" => $books,
        ];

        return $this->render("book/show-all.html.twig", $data);
    }

    /**
     * @Route("/book/show/{id}", name="book_show_one")
     */
    public function showBookById(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository
            ->find($id);

        $data = [
            "book" => $book,
        ];
        
        return $this->render("book/show-one.html.twig", $data);
    }

    /**
     * @Route("/book/delete/{id}", name="book_delete", methods={"GET","HEAD"})
     */
    public function deleteBook(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository
            ->find($id);

        $data = [
            "book" => $book,
        ];
        
        return $this->render("book/delete-book.html.twig", $data);
    }

    /**
     * @Route("/book/delete/{id}", name="book_delete_process", methods={"POST"})
     */
    public function deleteBookById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                "Finns ingen bok med id ".$id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute("book_show_all");
    }

    /**
     * @Route("/book/update/{id}", name="book_update", methods={"GET","HEAD"})
     */
    public function updateBook(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository
            ->find($id);

        $data = [
            "book" => $book,
        ];
        
        return $this->render("book/update-book.html.twig", $data);
    }

    /**
     * @Route("/book/update/{id}", name="book_update_process", methods={"POST"})
     */
    public function updateBookById(
        ManagerRegistry $doctrine,
        int $id,
        Request $request
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                "Finns ingen bok med id ".$id
            );
        }

        $title = $request->request->get("title");
        $isbn = $request->request->get("isbn");
        $author = $request->request->get("author");
        $image = $request->request->get("image");

        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImage($image);

        $entityManager->flush();

        return $this->redirectToRoute("book_show_all");
    }
}
