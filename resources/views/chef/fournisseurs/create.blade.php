You know, I need to help my place above. I. The. Set the left because Hosmer doesn't shibas. As a trainee has a clean. Deal. Here's your assessment camera number. This with diggy hairs and your number can be souvenir looking at work. The. What's that Hassan? Is that hassle? You have to check a little. Bit with you and I must say you can't do. I'm just going to think it's obviously. How can you? We're sorry, kids. Witness here. @extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center fs-4 fw-bold">
                    Ajouter un fournisseur
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('fournisseurs.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" name="type" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" name="adresse" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" name="telephone" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
