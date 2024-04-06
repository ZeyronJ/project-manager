<form action="{{ route('email.send', ['users' => 'kevin.rodast.95@gmail.com', 'title' => 'Titulo test', 'body' => 'Cuerpo test']) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="targetMailText" id="targetMailText" placeholder="target user">
    <input type="text" name="titleMailText" id="titleMailText" placeholder="title">
    <textarea name="bodyMailText" id="bodyMailText" cols="40" rows="5" placeholder="body"></textarea>
    <button type="submit" id="sendMailBtn" class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2">                            
        Enviar Mail
    </button>
</form>