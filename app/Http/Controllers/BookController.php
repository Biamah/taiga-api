<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Retorna a lista de todos os livros.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        // Recupera todos os livros do banco de dados
        $books = $query->with(['publisher', 'targetAudience'])->paginate(15);

        // Retorna a lista de livros em formato JSON
        return response()->json($books);
    }

    /**
     * Cadastra um novo livro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'title'              => 'required|string|max:255',
            'publication_date'   => 'required|date',
            'publisher_id'       => 'required|exists:publishers,id',
            'target_audience_id' => 'required|exists:target_audiences,id',
            'category'           => 'required|string|max:255',
        ]);

        // Se a validação falhar, retorna erro 422
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Cria o livro no banco de dados
        $book = Book::create($validator->validated());

        // Retorna o livro criado com status 201
        return response()->json($book, 201);
    }

    /**
     * Retorna os detalhes de um livro específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Busca o livro pelo ID
        $book = Book::with(['publisher', 'targetAudience'])->find($id);

        // Se o livro não for encontrado, retorna um erro 404
        if (! $book) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
        }

        // Retorna os detalhes do livro em formato JSON
        return response()->json($book);
    }

    /**
     * Atualiza os dados de um livro específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Busca o livro pelo ID
        $book = Book::find($id);

        // Se o livro não for encontrado, retorna um erro 404
        if (! $book) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
        }

        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'title'              => 'sometimes|string|max:255',
            'publication_date'   => 'sometimes|date',
            'publisher_id'       => 'sometimes|exists:publishers,id',
            'target_audience_id' => 'sometimes|exists:target_audiences,id',
            'category'           => 'sometimes|string|max:255',
        ]);

        // Se a validação falhar, retorna erro 422
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Atualiza o livro com os dados validados
        $book->update($validator->validated());

        // Carrega os relacionamentos atualizados
        $book->load(['publisher', 'targetAudience']);

        // Retorna o livro atualizado em formato JSON
        return response()->json($book);
    }

    /**
     * Exclui um livro específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Busca o livro pelo ID
        $book = Book::find($id);

        // Se o livro não for encontrado, retorna um erro 404
        if (! $book) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
        }

        // Exclui o livro
        $book->delete();

        // Retorna uma resposta de sucesso
        return response()->json(['message' => 'Livro excluído com sucesso'], 200);
    }
}
