<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolygonsModel extends Model
{
    protected $table = 'polygons';

    protected $guarded = ['id'];

    public function geojson_polygons()
    {
        // Ambil data dari database
        $polygons = DB::table('polygons')
    ->select(DB::raw('
        polygons.id,
        ST_AsGeoJSON(polygons.geom) as geom,
        polygons.name,
        polygons.description,
        polygons.image,
        ST_Area(polygons.geom, true) as area_m2,
        ST_Area(polygons.geom, true) / 1000000 as area_km2,
        ST_Area(polygons.geom, true) / 10000 as area_hektar,
        polygons.created_at,
        polygons.updated_at,
        polygons.user_id,
        users.name as user_created
    '))
    ->leftJoin('users', 'polygons.user_id', '=', 'users.id')
    ->get();


        // Bangun struktur GeoJSON
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'image' => $p->image,
                    'area_m2' => $p->area_m2,
                    'area_km2' => $p->area_km2,
                    'area_hektar' => $p->area_hektar,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'user_id' => $p->user_id,
                    'user_created' => $p->user_created,
                ],
            ];

            $geojson['features'][] = $feature;
        }

        // Kembalikan GeoJSON
        return $geojson;
    }
    public function geojson_polygon($id)
    {
        // Ambil data dari database
        $polygons = $this
            ->select(DB::raw('id, st_asgeojson(geom) as geom, name, description, image, st_area(geom, true) as area_m2, st_area(geom, true) / 1000000 as area_km2, st_area(geom, true) / 10000 as area_hektar, created_at, updated_at'))
            ->where('id', $id)
            ->get();

        // Bangun struktur GeoJSON
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'image' => $p->image,
                    'area_m2' => $p->area_m2,
                    'area_km2' => $p->area_km2,
                    'area_hektar' => $p->area_hektar,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                ],
            ];

            $geojson['features'][] = $feature;
        }

        // Kembalikan GeoJSON
        return $geojson;
    }
}
